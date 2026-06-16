<x-layouts.app :title="$profile->display_name">
    <style>
        :root {
            --color-brand-500: {{ $profile->theme_color }};
            --color-brand-600: {{ $profile->theme_color }};
        }
    </style>
    <main class="mx-auto flex min-h-screen max-w-xl flex-col items-center px-6 py-16">
        <div class="w-full space-y-12">
            <header class="flex flex-col items-center gap-6 text-center">
                <div class="relative">
                    @if ($profile->avatarUrl())
                        <img
                            src="{{ $profile->avatarUrl() }}"
                            alt="{{ $profile->display_name }}"
                            class="size-28 rounded-[2.5rem] object-cover shadow-2xl ring-4 ring-white"
                        >
                    @else
                        <div 
                            class="flex size-28 items-center justify-center rounded-[2.5rem] text-4xl font-bold text-white shadow-2xl ring-4 ring-white"
                            style="background-color: {{ $profile->theme_color }}"
                        >
                            {{ $profile->initials() }}
                        </div>
                    @endif
                </div>

                <div class="space-y-3">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">{{ $profile->display_name }}</h1>
                    @if ($profile->bio)
                        <p class="mx-auto max-w-sm text-base leading-relaxed text-slate-600">{{ $profile->bio }}</p>
                    @endif
                </div>
            </header>

            <section class="flex flex-col gap-4">
                @forelse ($profile->links->where('is_active', true) as $link)
                    <a
                        href="{{ $link->url }}"
                        target="_blank"
                        rel="noreferrer noopener"
                        class="group relative flex min-h-[4rem] items-center justify-center rounded-[1.5rem] border border-white/40 bg-white/80 px-8 py-4 text-center text-base font-semibold text-slate-900 shadow-[0_8px_30px_rgb(0,0,0,0.04)] backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:text-white active:scale-95"
                    >
                        <span class="relative z-10">{{ $link->title }}</span>
                        <div 
                            class="absolute inset-0 rounded-[1.5rem] opacity-0 transition-opacity group-hover:opacity-100"
                            style="background-color: {{ $profile->theme_color }}"
                        ></div>
                    </a>
                @empty
                    <div class="rounded-[2rem] border-2 border-dashed border-slate-200 bg-white/50 p-12 text-center backdrop-blur-sm">
                        <p class="text-sm font-medium text-slate-500">Belum ada link aktif.</p>
                    </div>
                @endforelse
            </section>

            <footer class="pt-12 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold tracking-widest text-slate-400 uppercase transition hover:opacity-70" style="color: {{ $profile->theme_color }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="size-4"><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9-9 9-9-1.8-9-9 1.8-9 9-9Z"/></svg>
                    Laravel Link Tree
                </a>
            </footer>
        </div>
    </main>
</x-layouts.app>
