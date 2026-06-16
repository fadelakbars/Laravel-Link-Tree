<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user()->load([
            'profile.links' => fn ($query) => $query->orderBy('sort_order'),
        ]);

        return view('dashboard', [
            'user' => $user,
            'profile' => $user->profile,
            'currentTab' => request('tab', 'links'),
        ]);
    }
}
