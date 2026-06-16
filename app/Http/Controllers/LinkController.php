<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function store(StoreLinkRequest $request): RedirectResponse
    {
        $request->user()->profile->links()->create($request->validated());

        return redirect()
            ->route('dashboard')
            ->with('status', 'Link baru berhasil ditambahkan.');
    }

    public function update(UpdateLinkRequest $request, Link $link): RedirectResponse
    {
        $this->findOwnedLink($request->user()->profile->id, $link)->update($request->validated());

        return redirect()
            ->route('dashboard')
            ->with('status', 'Link berhasil diperbarui.');
    }

    public function destroy(Request $request, Link $link): RedirectResponse
    {
        $this->findOwnedLink($request->user()->profile->id, $link)->delete();

        return redirect()
            ->route('dashboard')
            ->with('status', 'Link berhasil dihapus.');
    }

    private function findOwnedLink(int $profileId, Link $link): Link
    {
        return Link::query()
            ->where('profile_id', $profileId)
            ->findOrFail($link->id);
    }
}
