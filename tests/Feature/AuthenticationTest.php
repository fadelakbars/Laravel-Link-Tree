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
