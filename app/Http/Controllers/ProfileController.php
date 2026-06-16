<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $request->user()->profile()->update($request->validated());

        return redirect()
            ->route('dashboard')
            ->with('status', 'Profil publik berhasil diperbarui.');
    }
}
