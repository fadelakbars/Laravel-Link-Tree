<x-layouts.app title="Dashboard">
    <main class="mx-auto flex min-h-screen max-w-6xl flex-col gap-8 px-6 py-8 lg:px-10">
        <header class="flex flex-col gap-4 rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.3)] backdrop-blur lg:flex-row lg:items-center lg:justify-between">
            <div class="space-y-2">
                <p class="text-sm font-medium text-[var(--color-brand-600)]">Dashboard</p>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-950">Halo, {{ $user->name }}</h1>
                <p class="text-sm leading-6 text-slate-600">
                    Fondasi fase 1 sudah siap: auth session, route publik berbasis slug, dan struktur data profile + links.
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                    Logout
                </button>
            </form>
        </header>

        <section class="grid gap-6 lg:grid-cols-[1.25fr_0.75fr]">
            <article class="rounded-[2rem] border border-black/5 bg-white p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.24)]">
                <div class="space-y-3">
                    <p class="text-sm font-medium text-[var(--color-brand-600)]">Profil Publik</p>
                    <h2 class="text-2xl font-semibold text-slate-950">{{ $profile->display_name }}</h2>
                    <p class="text-sm leading-6 text-slate-600">{{ $profile->bio ?: 'Bio belum diisi.' }}</p>
                </div>

                <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-sm text-slate-500">Slug</dt>
                        <dd class="mt-2 text-base font-semibold text-slate-900">{{ $profile->slug }}</dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-sm text-slate-500">URL Publik</dt>
                        <dd class="mt-2 text-base font-semibold text-slate-900 break-all">
                            <a href="{{ route('profiles.show', $profile) }}" class="hover:text-[var(--color-brand-600)]">
                                {{ route('profiles.show', $profile) }}
                            </a>
                        </dd>
                    </div>
                </dl>
            </article>

            <aside class="rounded-[2rem] border border-black/5 bg-white p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.24)]">
                <div class="space-y-2">
                    <p class="text-sm font-medium text-[var(--color-brand-600)]">Status Fase 1</p>
                    <h2 class="text-xl font-semibold text-slate-950">Langkah selanjutnya</h2>
                </div>

                <ul class="mt-5 flex flex-col gap-3 text-sm text-slate-600">
                    <li class="rounded-2xl bg-slate-50 px-4 py-3">Tambahkan CRUD profil pada fase 2.</li>
                    <li class="rounded-2xl bg-slate-50 px-4 py-3">Tambahkan CRUD link dan pengaturan urutan.</li>
                    <li class="rounded-2xl bg-slate-50 px-4 py-3">Tambahkan preview dan penyempurnaan UX dashboard.</li>
                </ul>

                <div class="mt-6 rounded-2xl border border-dashed border-slate-200 p-4">
                    <p class="text-sm text-slate-500">Jumlah link saat ini</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-950">{{ $profile->links->count() }}</p>
                </div>
            </aside>
        </section>
    </main>
</x-layouts.app>
