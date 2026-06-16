<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Contracts\View\View;

class PublicProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Profile $profile): View
    {
        $profile->load([
            'links' => fn ($query) => $query
                ->where('is_active', true)
                ->orderBy('sort_order'),
        ]);

        return view('profiles.show', [
            'profile' => $profile,
        ]);
    }
}
