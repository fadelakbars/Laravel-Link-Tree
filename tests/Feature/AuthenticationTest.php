<?php

use App\Models\User;

test('guest can view login and register pages', function () {
    $this->get(route('login'))->assertSuccessful();
    $this->get(route('register'))->assertSuccessful();
});

test('user can register and receives a profile', function () {
    $response = $this->post(route('register'), [
        'name' => 'Fadel Akbar',
        'email' => 'fadel@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();

    $user = User::where('email', 'fadel@example.com')->firstOrFail();

    expect($user->profile)->not->toBeNull();
    expect($user->profile->slug)->toStartWith('fadel-akbar-');
});

test('authenticated user can login and reach dashboard', function () {
    $user = User::factory()->create([
        'email' => 'owner@example.com',
        'password' => 'password',
    ]);

    $user->profile()->create([
        'display_name' => 'Owner',
        'slug' => 'owner',
    ]);

    $response = $this->post(route('login'), [
        'email' => 'owner@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($user);
    $this->get(route('dashboard'))->assertSuccessful();
});

test('user can logout', function () {
    $user = User::factory()->create();

    $user->profile()->create([
        'display_name' => $user->name,
        'slug' => 'logout-user',
    ]);

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('login'));
    $this->assertGuest();
});

test('authenticated user can update profile details', function () {
    $user = User::factory()->create();

    $user->profile()->create([
        'display_name' => 'Old Name',
        'slug' => 'old-name',
        'bio' => 'Old bio',
    ]);

    $response = $this->actingAs($user)->put(route('profile.update'), [
        'display_name' => 'New Public Name',
        'slug' => 'New Public Slug',
        'bio' => 'Bio yang sudah diperbarui.',
    ]);

    $response->assertRedirect(route('dashboard'));
    $response->assertSessionHas('status', 'Profil publik berhasil diperbarui.');

    $user->refresh();

    expect($user->profile->display_name)->toBe('New Public Name');
    expect($user->profile->slug)->toBe('new-public-slug');
    expect($user->profile->bio)->toBe('Bio yang sudah diperbarui.');
});

test('profile update requires a unique slug', function () {
    $firstUser = User::factory()->create();
    $secondUser = User::factory()->create();

    $firstUser->profile()->create([
        'display_name' => 'First User',
        'slug' => 'first-user',
    ]);

    $secondUser->profile()->create([
        'display_name' => 'Second User',
        'slug' => 'second-user',
    ]);

    $response = $this->actingAs($secondUser)->from(route('dashboard'))->put(route('profile.update'), [
        'display_name' => 'Second User',
        'slug' => 'first-user',
        'bio' => null,
    ]);

    $response->assertRedirect(route('dashboard'));
    $response->assertSessionHasErrors('slug');
});
