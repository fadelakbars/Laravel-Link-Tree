<?php

use App\Models\User;

test('authenticated user can create a link', function () {
    $user = User::factory()->create();

    $user->profile()->create([
        'display_name' => 'Owner',
        'slug' => 'owner',
    ]);

    $response = $this->actingAs($user)->post(route('links.store'), [
        'title' => 'Portfolio',
        'url' => 'https://example.com/portfolio',
        'icon' => 'link',
        'sort_order' => 1,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('dashboard'));
    $response->assertSessionHas('status', 'Link baru berhasil ditambahkan.');

    $link = $user->profile->fresh()->links()->first();

    expect($link)->not->toBeNull();
    expect($link->title)->toBe('Portfolio');
    expect($link->is_active)->toBeTrue();
});

test('authenticated user can update an owned link', function () {
    $user = User::factory()->create();

    $profile = $user->profile()->create([
        'display_name' => 'Owner',
        'slug' => 'owner',
    ]);

    $link = $profile->links()->create([
        'title' => 'Old Link',
        'url' => 'https://example.com/old',
        'icon' => 'link',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($user)->put(route('links.update', $link), [
        'title' => 'Updated Link',
        'url' => 'https://example.com/new',
        'icon' => 'globe',
        'sort_order' => 3,
        'is_active' => '0',
    ]);

    $response->assertRedirect(route('dashboard'));
    $response->assertSessionHas('status', 'Link berhasil diperbarui.');

    $link->refresh();

    expect($link->title)->toBe('Updated Link');
    expect($link->url)->toBe('https://example.com/new');
    expect($link->icon)->toBe('globe');
    expect($link->sort_order)->toBe(3);
    expect($link->is_active)->toBeFalse();
});

test('authenticated user can delete an owned link', function () {
    $user = User::factory()->create();

    $profile = $user->profile()->create([
        'display_name' => 'Owner',
        'slug' => 'owner',
    ]);

    $link = $profile->links()->create([
        'title' => 'Delete Me',
        'url' => 'https://example.com/delete',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($user)->delete(route('links.destroy', $link));

    $response->assertRedirect(route('dashboard'));
    $response->assertSessionHas('status', 'Link berhasil dihapus.');
    $this->assertModelMissing($link);
});

test('user cannot update another users link', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();

    $ownerProfile = $owner->profile()->create([
        'display_name' => 'Owner',
        'slug' => 'owner',
    ]);

    $intruder->profile()->create([
        'display_name' => 'Intruder',
        'slug' => 'intruder',
    ]);

    $link = $ownerProfile->links()->create([
        'title' => 'Private Link',
        'url' => 'https://example.com/private',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($intruder)->put(route('links.update', $link), [
        'title' => 'Hijacked Link',
        'url' => 'https://example.com/hijacked',
        'icon' => 'globe',
        'sort_order' => 2,
        'is_active' => '1',
    ]);

    $response->assertForbidden();
    $link->refresh();

    expect($link->title)->toBe('Private Link');
});
