<x-layouts.app :title="$profile->display_name">
    <main class="mx-auto flex min-h-screen max-w-xl flex-col justify-center px-6 py-12">
        <section class="rounded-[2rem] border border-white/70 bg-white/95 p-6 shadow-[0_30px_90px_-42px_rgba(15,23,42,0.32)] backdrop-blur sm:p-8">
            <div class="flex flex-col items-center gap-5 text-center">
                <div class="flex size-24 items-center justify-center rounded-full bg-[var(--color-surface-100)] text-3xl font-semibold text-slate-800 shadow-sm">
                    {{ str($profile->display_name)->explode(' ')->take(2)->map(fn (string $part) => str($part)->substr(0, 1))->implode('') }}
                </div>

                <div class="space-y-2">
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-950">{{ $profile->display_name }}</h1>
                    @if ($profile->bio)
                        <p class="text-sm leading-7 text-slate-600">{{ $profile->bio }}</p>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-3">
                @forelse ($profile->links as $link)
                    <a
                        href="{{ $link->url }}"
                        target="_blank"
                        rel="noreferrer noopener"
                        class="inline-flex min-h-14 items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-4 text-center text-sm font-semibold text-slate-800 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50"
                    >
                        {{ $link->title }}
                    </a>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-5 py-6 text-center text-sm text-slate-500">
                        Belum ada link aktif.
                    </div>
                @endforelse
            </div>
        </section>
    </main>
</x-layouts.app>
