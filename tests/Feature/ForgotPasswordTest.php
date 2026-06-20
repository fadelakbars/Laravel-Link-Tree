<?php

use App\Models\PasswordResetRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('guest can view forgot password page', function () {
    $this->get(route('password.request'))->assertSuccessful();
});

test('submitting forgot password with non-existent email fails validation', function () {
    $response = $this->post(route('password.email'), [
        'email' => 'nonexistent@example.com',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertDatabaseEmpty('password_reset_requests');
});

test('submitting forgot password with registered email creates request', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
    ]);

    $response = $this->post(route('password.email'), [
        'email' => 'user@example.com',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('status');

    $this->assertDatabaseHas('password_reset_requests', [
        'email' => 'user@example.com',
        'status' => 'pending',
    ]);
});

test('guest cannot access admin password reset list', function () {
    $this->get(route('admin.users.index', ['tab' => 'resets']))
        ->assertRedirect(route('login'));
});

test('non-admin user cannot access admin password reset list', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $this->actingAs($user)
        ->get(route('admin.users.index', ['tab' => 'resets']))
        ->assertForbidden();
});

test('admin can view resets list tab', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $resetRequest = PasswordResetRequest::create([
        'email' => 'user@example.com',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.users.index', ['tab' => 'resets']))
        ->assertSuccessful();

    $response->assertSee('user@example.com');
});

test('admin can resolve password reset request and set new password', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => Hash::make('oldpassword'),
    ]);

    $resetRequest = PasswordResetRequest::create([
        'email' => 'user@example.com',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)
        ->post(route('admin.password-resets.resolve', $resetRequest), [
            'password' => 'newpassword123',
        ]);

    $response->assertRedirect(route('admin.users.index', ['tab' => 'resets']));
    $response->assertSessionHas('status');

    $resetRequest->refresh();
    expect($resetRequest->status)->toBe('resolved');

    $user->refresh();
    expect(Hash::check('newpassword123', $user->password))->toBeTrue();
});
