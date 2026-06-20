<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guest cannot access admin users list', function () {
    $this->get(route('admin.users.index'))->assertRedirect(route('login'));
});

test('regular user cannot access admin users list', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.users.index'))
        ->assertForbidden();
});

test('admin user can view admin users list', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertSuccessful()
        ->assertSee($admin->name);
});

test('admin user can search for users', function () {
    $admin = User::factory()->admin()->create();
    $targetUser = User::factory()->create(['name' => 'UniqueNameSearchTarget']);
    $otherUser = User::factory()->create(['name' => 'RegularUserUnique']);

    $response = $this->actingAs($admin)
        ->get(route('admin.users.index', ['search' => 'UniqueNameSearchTarget']))
        ->assertSuccessful();

    $response->assertSee('UniqueNameSearchTarget');
    $response->assertDontSee('RegularUserUnique');
});

test('admin user can toggle another users admin role', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($admin)
        ->post(route('admin.users.toggle-admin', $user));

    $response->assertRedirect(route('admin.users.index'));
    $response->assertSessionHas('status', 'Peran pengguna berhasil diperbarui.');

    expect($user->fresh()->is_admin)->toBeTrue();

    // Toggle back to false
    $this->actingAs($admin)
        ->post(route('admin.users.toggle-admin', $user));

    expect($user->fresh()->is_admin)->toBeFalse();
});

test('admin user cannot toggle their own admin role', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)
        ->from(route('admin.users.index'))
        ->post(route('admin.users.toggle-admin', $admin));

    $response->assertRedirect(route('admin.users.index'));
    $response->assertSessionHas('error', 'Anda tidak dapat mengubah status admin Anda sendiri.');

    expect($admin->fresh()->is_admin)->toBeTrue();
});

test('admin user can delete another user and their avatar', function () {
    Storage::fake('public');

    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    $avatarFile = UploadedFile::fake()->image('avatar.jpg');
    $avatarPath = $avatarFile->store('avatars/profiles', 'public');

    $user->profile()->create([
        'display_name' => $user->name,
        'slug' => 'test-delete-user',
        'avatar_path' => $avatarPath,
    ]);

    Storage::disk('public')->assertExists($avatarPath);

    $response = $this->actingAs($admin)
        ->delete(route('admin.users.destroy', $user));

    $response->assertRedirect(route('admin.users.index'));
    $response->assertSessionHas('status', 'Pengguna berhasil dihapus.');

    $this->assertModelMissing($user);
    Storage::disk('public')->assertMissing($avatarPath);
});

test('admin user cannot delete their own account', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)
        ->from(route('admin.users.index'))
        ->delete(route('admin.users.destroy', $admin));

    $response->assertRedirect(route('admin.users.index'));
    $response->assertSessionHas('error', 'Anda tidak dapat menghapus akun Anda sendiri.');

    $this->assertModelExists($admin);
});
