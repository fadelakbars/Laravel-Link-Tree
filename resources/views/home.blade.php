<x-layouts.app title="Laravel Link Tree">
    <main class="mx-auto flex min-h-screen max-w-6xl flex-col justify-center gap-16 px-6 py-12 lg:flex-row lg:items-center lg:px-10">
        <section class="max-w-2xl space-y-8">
            <div class="inline-flex items-center rounded-full border border-[var(--color-brand-100)] bg-white px-4 py-2 text-sm font-medium text-[var(--color-brand-600)] shadow-sm">
                Laravel Link Tree
            </div>

            <div class="space-y-5">
                <h1 class="max-w-xl text-4xl font-semibold tracking-tight text-slate-950 sm:text-5xl">
                    Satu halaman publik yang bersih untuk semua link pentingmu.
                </h1>
                <p class="max-w-xl text-lg leading-8 text-slate-600">
                    Fondasi proyek ini dibangun untuk pengalaman yang clean, modern, light mode, dan ringan di mobile.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl bg-[var(--color-brand-500)] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[var(--color-brand-600)]">
                    Buat Akun
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                    Masuk Dashboard
                </a>
            </div>
        </section>

        <section class="w-full max-w-md rounded-[2rem] border border-white/70 bg-white/90 p-5 shadow-[0_30px_90px_-40px_rgba(15,23,42,0.35)] backdrop-blur">
            <div class="rounded-[1.5rem] bg-[var(--color-surface-100)] p-6">
                <div class="flex flex-col items-center gap-4 text-center">
                    <div class="flex size-20 items-center justify-center rounded-full bg-white text-2xl font-semibold text-slate-800 shadow-sm">
                        FA
                    </div>
                    <div class="space-y-2">
                        <h2 class="text-xl font-semibold text-slate-950">Fadel Akbar</h2>
                        <p class="text-sm leading-6 text-slate-600">
                            Developer, creator, dan pemilik satu halaman ringkas untuk semua tautan utama.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex flex-col gap-3">
                    @foreach (['Portfolio', 'WhatsApp', 'Instagram'] as $label)
                        <div class="rounded-2xl border border-slate-200 bg-white px-5 py-4 text-center text-sm font-medium text-slate-700 shadow-sm">
                            {{ $label }}
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</x-layouts.app>
