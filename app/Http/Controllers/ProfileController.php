<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $profile = $request->user()->profile;
        $validated = $request->safe()->except(['avatar']);

        if ($request->hasFile('avatar')) {
            $newAvatarPath = $request->file('avatar')->store('avatars/profiles', 'public');

            if ($profile->avatar_path !== null) {
                Storage::disk('public')->delete($profile->avatar_path);
            }

            $validated['avatar_path'] = $newAvatarPath;
        }

        $profile->update($validated);

        return redirect()
            ->route('dashboard')
            ->with('status', 'Profil publik berhasil diperbarui.');
    }
}
