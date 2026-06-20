<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(Request $request): View
    {
        $tab = $request->input('tab', 'users');
        $search = $request->input('search');

        $pendingResetsCount = PasswordResetRequest::where('status', 'pending')->count();

        if ($tab === 'resets') {
            $resets = PasswordResetRequest::query()
                ->when($search, function ($query, $search): void {
                    $query->where('email', 'like', '%'.$search.'%');
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            $users = collect();
        } else {
            $users = User::query()
                ->with(['profile' => function ($query): void {
                    $query->withCount('links');
                }])
                ->when($search, function ($query, $search): void {
                    $query->where(function ($q) use ($search): void {
                        $q->where('name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%');
                    });
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            $resets = collect();
        }

        return view('admin.users.index', compact('users', 'resets', 'tab', 'pendingResetsCount'));
    }

    public function toggleAdmin(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return redirect()
                ->back()
                ->with('error', 'Anda tidak dapat mengubah status admin Anda sendiri.');
        }

        $user->update([
            'is_admin' => ! $user->is_admin,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Peran pengguna berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return redirect()
                ->back()
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $profile = $user->profile;
        if ($profile !== null && $profile->avatar_path !== null) {
            Storage::disk('public')->delete($profile->avatar_path);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Pengguna berhasil dihapus.');
    }

    public function resolvePasswordReset(Request $request, PasswordResetRequest $passwordResetRequest): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
        ]);

        $user = User::where('email', $passwordResetRequest->email)->first();

        if ($user === null) {
            return redirect()
                ->back()
                ->with('error', 'Pengguna dengan email tersebut tidak ditemukan.');
        }

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        $passwordResetRequest->update([
            'status' => 'resolved',
        ]);

        return redirect()
            ->route('admin.users.index', ['tab' => 'resets'])
            ->with('status', 'Password berhasil direset. Silakan salin password baru ini dan kirimkan ke email '.$user->email.' secara manual: '.$request->input('password'));
    }
}
