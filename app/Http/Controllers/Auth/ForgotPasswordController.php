<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreForgotPasswordRequest;
use App\Models\PasswordResetRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(StoreForgotPasswordRequest $request): RedirectResponse
    {
        PasswordResetRequest::create([
            'email' => $request->validated('email'),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('login')
            ->with('status', 'Permintaan reset password Anda telah diajukan ke admin. Silakan tunggu informasi selanjutnya.');
    }
}
