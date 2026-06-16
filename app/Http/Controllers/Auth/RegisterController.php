<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = DB::transaction(function () use ($validated): User {
            $user = User::create($validated);

            $user->profile()->create([
                'display_name' => $validated['name'],
                'slug' => Str::slug($validated['name']).'-'.Str::lower(Str::random(6)),
                'bio' => 'Tambahkan bio singkatmu di fase berikutnya.',
            ]);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}
