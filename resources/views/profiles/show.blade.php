<x-layouts.app :title="$profile->display_name">
    <style>
        :root {
            --theme-color: {{ $profile->theme_color }};
            --theme-color-soft: color-mix(in srgb, {{ $profile->theme_color }}, white 92%);
            --theme-color-ghost: color-mix(in srgb, {{ $profile->theme_color }}, white 96%);
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
                            class="flex size-28 items-center justify-center rounded-[2.5rem] text-4xl font-bold shadow-2xl ring-4 ring-white"
                            style="background-color: var(--theme-color-soft); color: var(--theme-color);"
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
                        class="group relative flex min-h-[4.5rem] items-center justify-center rounded-[1.5rem] border border-slate-100 bg-white px-8 py-4 text-center text-base font-semibold text-slate-800 shadow-[0_4px_20px_rgba(0,0,0,0.03)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.06)] active:scale-95"
                    >
                        <!-- Hover Border Accent -->
                        <div 
                            class="absolute inset-0 rounded-[1.5rem] border-2 border-transparent transition-colors duration-300 group-hover:border-[var(--theme-color)]"
                        ></div>

                        <!-- Subtle Hover Tint -->
                        <div 
                            class="absolute inset-0 rounded-[1.5rem] opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                            style="background-color: var(--theme-color-ghost);"
                        ></div>

                        <span class="relative z-10 transition-colors duration-300 group-hover:text-[var(--theme-color)]">{{ $link->title }}</span>
                        
                        <div class="absolute right-6 opacity-0 transition-all duration-300 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0" style="color: var(--theme-color);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                        </div>
                    </a>
                @empty
                    <div class="rounded-[2rem] border-2 border-dashed border-slate-200 bg-white/50 p-12 text-center backdrop-blur-sm">
                        <p class="text-sm font-medium text-slate-500">Belum ada link aktif.</p>
                    </div>
                @endforelse
            </section>

            <footer class="pt-12 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-[10px] font-black tracking-widest text-slate-300 uppercase transition hover:opacity-100" style="hover: color: var(--theme-color);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9-9 9-9-1.8-9-9 1.8-9 9-9Z"/></svg>
                    Laravel Link Tree
                </a>
            </footer>
        </div>
    </main>
</x-layouts.app>
