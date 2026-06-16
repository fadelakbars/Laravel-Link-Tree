<x-layouts.app title="Laravel Link Tree — One Link for Everything">
    <main class="mx-auto flex min-h-screen max-w-7xl flex-col items-center justify-center px-6 py-12 lg:px-10">
        <div class="grid w-full gap-16 lg:grid-cols-2 lg:items-center">
            <section class="order-2 space-y-10 lg:order-1">
                <div class="inline-flex items-center gap-2 rounded-full border border-[var(--color-brand-100)] bg-white px-4 py-2 text-sm font-bold tracking-tight text-[var(--color-brand-600)] shadow-xs">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[var(--color-brand-400)] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[var(--color-brand-500)]"></span>
                    </span>
                    Laravel Link Tree
                </div>

                <div class="space-y-6">
                    <h1 class="text-5xl font-extrabold tracking-tighter text-slate-950 sm:text-7xl">
                        Satu Link untuk <span class="text-[var(--color-brand-500)]">Segalanya.</span>
                    </h1>
                    <p class="max-w-xl text-lg leading-relaxed text-slate-600">
                        Bangun halaman publik yang bersih, modern, dan minimalis hanya dalam hitungan detik. Fondasi ringan, performa kencang, dan desain yang memikat di setiap perangkat.
                    </p>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row">
                    <a href="{{ route('register') }}" class="inline-flex h-14 items-center justify-center rounded-2xl bg-slate-950 px-8 text-base font-bold text-white transition hover:bg-slate-800 shadow-xl shadow-slate-950/20 active:scale-95">
                        Mulai Gratis Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex h-14 items-center justify-center rounded-2xl border border-slate-200 bg-white px-8 text-base font-bold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50 active:scale-95">
                        Masuk Dashboard
                    </a>
                </div>

                <div class="flex items-center gap-6 pt-4">
                    <div class="flex -space-x-3">
                        @foreach(range(1, 4) as $i)
                            <div class="size-10 rounded-full border-2 border-white bg-slate-100 shadow-sm flex items-center justify-center text-[10px] font-bold text-slate-400">U{{ $i }}</div>
                        @endforeach
                    </div>
                    <p class="text-sm font-medium text-slate-500">
                        <span class="font-bold text-slate-900">100+</span> creator sudah bergabung
                    </p>
                </div>
            </section>

            <section class="order-1 flex justify-center lg:order-2">
                <div class="relative w-full max-w-sm">
                    <!-- Decorative shapes -->
                    <div class="absolute -top-12 -right-12 size-64 rounded-full bg-[var(--color-brand-100)] opacity-40 blur-3xl"></div>
                    <div class="absolute -bottom-12 -left-12 size-64 rounded-full bg-slate-200 opacity-40 blur-3xl"></div>

                    <div class="relative rounded-[3rem] border-[12px] border-white bg-white p-6 shadow-[0_40px_100px_-20px_rgba(15,23,42,0.15)] ring-1 ring-slate-100 backdrop-blur-sm">
                        <div class="flex flex-col items-center gap-6 text-center">
                            <div class="size-24 rounded-[2rem] bg-[var(--color-surface-100)] flex items-center justify-center text-4xl font-bold text-slate-800 shadow-inner">
                                FA
                            </div>
                            <div class="space-y-2">
                                <h2 class="text-2xl font-bold text-slate-900">Fadel Akbar</h2>
                                <p class="text-sm leading-6 text-slate-500 px-4">
                                    Developer & Creator yang menyukai kesederhanaan dalam desain.
                                </p>
                            </div>
                        </div>

                        <div class="mt-10 flex flex-col gap-3">
                            @foreach (['Portfolio', 'WhatsApp', 'Instagram', 'Github'] as $label)
                                <div class="group relative flex h-14 items-center justify-center rounded-2xl border border-slate-100 bg-slate-50/50 px-5 text-sm font-bold text-slate-700 shadow-xs transition hover:bg-white hover:shadow-lg hover:shadow-slate-200/50">
                                    {{ $label }}
                                    <svg class="absolute right-4 size-4 opacity-0 transition group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-10 pt-6 border-t border-slate-50 text-center">
                            <div class="inline-flex items-center gap-2 text-[10px] font-black tracking-widest text-slate-300 uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="size-3"><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9-9 9-9-1.8-9-9 1.8-9 9-9Z"/></svg>
                                Laravel Link Tree
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layouts.app>
