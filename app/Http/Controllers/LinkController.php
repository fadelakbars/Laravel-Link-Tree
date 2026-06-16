<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function moveUp(Request $request, Link $link): RedirectResponse
    {
        $link = $this->findOwnedLink($request->user()->profile->id, $link);

        $swapLink = Link::query()
            ->where('profile_id', $link->profile_id)
            ->where('sort_order', '<', $link->sort_order)
            ->orderByDesc('sort_order')
            ->first();

        if ($swapLink === null) {
            return redirect()
                ->route('dashboard')
                ->with('status', 'Link ini sudah berada di urutan paling atas.');
        }

        $this->swapSortOrder($link, $swapLink);

        return redirect()
            ->route('dashboard')
            ->with('status', 'Urutan link berhasil dinaikkan.');
    }

    public function moveDown(Request $request, Link $link): RedirectResponse
    {
        $link = $this->findOwnedLink($request->user()->profile->id, $link);

        $swapLink = Link::query()
            ->where('profile_id', $link->profile_id)
            ->where('sort_order', '>', $link->sort_order)
            ->orderBy('sort_order')
            ->first();

        if ($swapLink === null) {
            return redirect()
                ->route('dashboard')
                ->with('status', 'Link ini sudah berada di urutan paling bawah.');
        }

        $this->swapSortOrder($link, $swapLink);

        return redirect()
            ->route('dashboard')
            ->with('status', 'Urutan link berhasil diturunkan.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:links,id'],
        ]);

        $profileId = $request->user()->profile->id;
        $ids = $request->input('ids');

        DB::transaction(function () use ($profileId, $ids): void {
            foreach ($ids as $index => $id) {
                Link::query()
                    ->where('profile_id', $profileId)
                    ->where('id', $id)
                    ->update(['sort_order' => $index + 1]);
            }
        });

        return redirect()
            ->route('dashboard')
            ->with('status', 'Urutan link berhasil diperbarui.');
    }

    private function findOwnedLink(int $profileId, Link $link): Link
    {
        return Link::query()
            ->where('profile_id', $profileId)
            ->findOrFail($link->id);
    }

    private function swapSortOrder(Link $firstLink, Link $secondLink): void
    {
        DB::transaction(function () use ($firstLink, $secondLink): void {
            $originalSortOrder = $firstLink->sort_order;

            $firstLink->update([
                'sort_order' => $secondLink->sort_order,
            ]);

            $secondLink->update([
                'sort_order' => $originalSortOrder,
            ]);
        });
    }
}
