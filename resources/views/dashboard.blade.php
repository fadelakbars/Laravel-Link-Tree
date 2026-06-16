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

        @if (session('status'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <section class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
            <article class="rounded-[2rem] border border-black/5 bg-white p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.24)]">
                <div class="space-y-2">
                    <p class="text-sm font-medium text-[var(--color-brand-600)]">Edit Profil</p>
                    <h2 class="text-2xl font-semibold text-slate-950">Perbarui identitas halaman publikmu</h2>
                    <p class="text-sm leading-6 text-slate-600">
                        Pada tahap ini kamu sudah bisa mengubah nama tampilan, slug URL, dan bio singkat.
                    </p>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" class="mt-6 flex flex-col gap-5">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label for="display_name" class="text-sm font-medium text-slate-700">Display Name</label>
                            <input
                                id="display_name"
                                name="display_name"
                                type="text"
                                value="{{ old('display_name', $profile->display_name) }}"
                                class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[var(--color-brand-500)]"
                                required
                            >
                            @error('display_name')
                                <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="slug" class="text-sm font-medium text-slate-700">Slug URL</label>
                            <input
                                id="slug"
                                name="slug"
                                type="text"
                                value="{{ old('slug', $profile->slug) }}"
                                class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[var(--color-brand-500)]"
                                required
                            >
                            <p class="text-xs leading-5 text-slate-500">
                                URL publik akan menjadi <span class="font-medium text-slate-700">{{ url('/') }}/slug-kamu</span>
                            </p>
                            @error('slug')
                                <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="bio" class="text-sm font-medium text-slate-700">Bio Singkat</label>
                        <textarea
                            id="bio"
                            name="bio"
                            rows="5"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[var(--color-brand-500)]"
                            placeholder="Tuliskan deskripsi singkat tentang dirimu atau brand-mu."
                        >{{ old('bio', $profile->bio) }}</textarea>
                        @error('bio')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-3 rounded-2xl bg-slate-50 p-4 text-sm text-slate-600 sm:flex-row sm:items-center sm:justify-between">
                        <p>Perubahan ini langsung memengaruhi halaman publik profilmu.</p>
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[var(--color-brand-500)] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[var(--color-brand-600)]">
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </article>

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
        </section>

        <section class="grid gap-6 lg:grid-cols-[1.25fr_0.75fr]">
            <article class="rounded-[2rem] border border-black/5 bg-white p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.24)]">
                <div class="space-y-2">
                    <p class="text-sm font-medium text-[var(--color-brand-600)]">Manajemen Link</p>
                    <h2 class="text-xl font-semibold text-slate-950">Tambah dan kelola link publikmu</h2>
                    <p class="text-sm leading-6 text-slate-600">
                        Gunakan tombol naik dan turun untuk menukar urutan link tanpa harus mengubah angka secara manual.
                    </p>
                </div>

                <form method="POST" action="{{ route('links.store') }}" class="mt-5 grid gap-4 rounded-[1.5rem] bg-slate-50 p-4 md:grid-cols-2">
                    @csrf

                    <div class="flex flex-col gap-2 md:col-span-2">
                        <label for="link_title" class="text-sm font-medium text-slate-700">Judul Link</label>
                        <input
                            id="link_title"
                            name="title"
                            type="text"
                            value="{{ old('title') }}"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[var(--color-brand-500)]"
                            placeholder="Contoh: Portfolio, WhatsApp, Toko Online"
                            required
                        >
                        @error('title')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2 md:col-span-2">
                        <label for="link_url" class="text-sm font-medium text-slate-700">URL</label>
                        <input
                            id="link_url"
                            name="url"
                            type="url"
                            value="{{ old('url') }}"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[var(--color-brand-500)]"
                            placeholder="https://example.com"
                            required
                        >
                        @error('url')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="link_icon" class="text-sm font-medium text-slate-700">Icon / Label</label>
                        <input
                            id="link_icon"
                            name="icon"
                            type="text"
                            value="{{ old('icon') }}"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[var(--color-brand-500)]"
                            placeholder="Contoh: link"
                        >
                        @error('icon')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="link_sort_order" class="text-sm font-medium text-slate-700">Urutan</label>
                        <input
                            id="link_sort_order"
                            name="sort_order"
                            type="number"
                            min="1"
                            value="{{ old('sort_order', max($profile->links->count(), 1)) }}"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                            required
                        >
                        @error('sort_order')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <label class="flex items-center gap-3 text-sm text-slate-600">
                            <input type="hidden" name="is_active" value="0">
                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(old('is_active', true))
                                class="size-4 rounded border-slate-300 text-[var(--color-brand-500)]"
                            >
                            <span>Langsung aktifkan link ini</span>
                        </label>

                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[var(--color-brand-500)] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[var(--color-brand-600)]">
                            Tambah Link
                        </button>
                    </div>
                </form>

                <div class="mt-5 flex flex-col gap-4">
                    @forelse ($profile->links as $link)
                        <div class="rounded-[1.5rem] border border-slate-200 bg-white p-4 shadow-sm">
                            <div class="mb-4 flex flex-col gap-3 rounded-2xl bg-slate-50 p-3 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">{{ $link->title }}</p>
                                    <p class="text-xs text-slate-500">Urutan saat ini: {{ $link->sort_order }}</p>
                                </div>

                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('links.move-up', $link) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-100">
                                            Naik
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('links.move-down', $link) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-100">
                                            Turun
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('links.update', $link) }}">
                                @csrf
                                @method('PUT')

                                <div class="grid gap-4 md:grid-cols-2">
                                    <div class="flex flex-col gap-2 md:col-span-2">
                                        <label for="title_{{ $link->id }}" class="text-sm font-medium text-slate-700">Judul Link</label>
                                        <input
                                            id="title_{{ $link->id }}"
                                            name="title"
                                            type="text"
                                            value="{{ $link->title }}"
                                            class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                                            required
                                        >
                                    </div>

                                    <div class="flex flex-col gap-2 md:col-span-2">
                                        <label for="url_{{ $link->id }}" class="text-sm font-medium text-slate-700">URL</label>
                                        <input
                                            id="url_{{ $link->id }}"
                                            name="url"
                                            type="url"
                                            value="{{ $link->url }}"
                                            class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                                            required
                                        >
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label for="icon_{{ $link->id }}" class="text-sm font-medium text-slate-700">Icon / Label</label>
                                        <input
                                            id="icon_{{ $link->id }}"
                                            name="icon"
                                            type="text"
                                            value="{{ $link->icon }}"
                                            class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                                        >
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label for="sort_order_{{ $link->id }}" class="text-sm font-medium text-slate-700">Urutan</label>
                                        <input
                                            id="sort_order_{{ $link->id }}"
                                            name="sort_order"
                                            type="number"
                                            min="1"
                                            value="{{ $link->sort_order }}"
                                            class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                                            required
                                        >
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-col gap-3 border-t border-slate-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                                    <label class="flex items-center gap-3 text-sm text-slate-600">
                                        <input type="hidden" name="is_active" value="0">
                                        <input
                                            type="checkbox"
                                            name="is_active"
                                            value="1"
                                            @checked($link->is_active)
                                            class="size-4 rounded border-slate-300 text-[var(--color-brand-500)]"
                                        >
                                        <span>{{ $link->is_active ? 'Link aktif' : 'Link nonaktif' }}</span>
                                    </label>

                                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('links.destroy', $link) }}" class="mt-3 flex justify-end border-t border-slate-100 pt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-rose-200 bg-rose-50 px-4 py-2.5 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">
                                    Hapus Link
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-5 py-6 text-center text-sm text-slate-500">
                            Belum ada link. Tahap berikutnya kita akan tambahkan CRUD link di dashboard.
                        </div>
                    @endforelse
                </div>
            </article>

            <aside class="rounded-[2rem] border border-black/5 bg-white p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.24)]">
                <div class="space-y-2">
                    <p class="text-sm font-medium text-[var(--color-brand-600)]">Status Tahap Ini</p>
                    <h2 class="text-xl font-semibold text-slate-950">Langkah selanjutnya</h2>
                </div>

                <ul class="mt-5 flex flex-col gap-3 text-sm text-slate-600">
                    <li class="rounded-2xl bg-slate-50 px-4 py-3">Edit profil sudah aktif di dashboard.</li>
                    <li class="rounded-2xl bg-slate-50 px-4 py-3">CRUD link sekarang tersedia di dashboard.</li>
                    <li class="rounded-2xl bg-slate-50 px-4 py-3">Kontrol naik dan turun sudah tersedia untuk pengaturan urutan cepat.</li>
                </ul>

                <div class="mt-6 rounded-2xl border border-dashed border-slate-200 p-4">
                    <p class="text-sm text-slate-500">Jumlah link saat ini</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-950">{{ $profile->links->count() }}</p>
                </div>
            </aside>
        </section>
    </main>
</x-layouts.app>
