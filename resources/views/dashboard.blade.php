<x-layouts.app title="Dashboard">
    <main class="mx-auto flex min-h-screen max-w-6xl flex-col gap-8 px-6 py-8 lg:px-10">
        <header class="flex flex-col gap-6 rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.3)] backdrop-blur lg:p-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-1">
                    <p class="text-sm font-medium text-[var(--color-brand-600)]">Welcome back</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-950">Halo, {{ $user->name }}</h1>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('profiles.show', $profile) }}" target="_blank" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                        Lihat Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <nav class="flex items-center gap-1 rounded-2xl bg-slate-100 p-1.5 w-fit">
                <a 
                    href="{{ route('dashboard', ['tab' => 'links']) }}" 
                    class="rounded-xl px-5 py-2 text-sm font-medium transition {{ $currentTab === 'links' ? 'bg-white text-slate-950 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}"
                >
                    Links
                </a>
                <a 
                    href="{{ route('dashboard', ['tab' => 'profile']) }}" 
                    class="rounded-xl px-5 py-2 text-sm font-medium transition {{ $currentTab === 'profile' ? 'bg-white text-slate-950 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}"
                >
                    Pengaturan Profil
                </a>
            </nav>
        </header>

        <div class="grid gap-8 lg:grid-cols-[1fr_400px]">
            <div class="space-y-8">
                @if ($currentTab === 'links')
                    <section class="space-y-6">
                        <details class="group rounded-[2rem] border border-black/5 bg-white shadow-[0_24px_80px_-40px_rgba(15,23,42,0.24)] lg:p-2 overflow-hidden" {{ old('title') || $errors->any() ? 'open' : '' }}>
                            <summary class="list-none cursor-pointer p-6 lg:p-8 flex items-center justify-between group-open:pb-2 transition-all">
                                <div class="space-y-1">
                                    <h2 class="text-2xl font-semibold text-slate-950">Kelola Link</h2>
                                    <p class="text-sm leading-6 text-slate-600">
                                        Tambah, hapus, dan atur urutan link publikmu.
                                    </p>
                                </div>
                                <div class="flex size-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 group-open:rotate-45 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                                </div>
                            </summary>

                            <div class="px-6 pb-6 lg:px-8 lg:pb-8 pt-4 border-t border-slate-50">
                                <form method="POST" action="{{ route('links.store') }}" class="grid gap-5 md:grid-cols-2">
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
                                            type="text"
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
                                        <label for="link_icon" class="text-sm font-medium text-slate-700">Icon / Label (Opsional)</label>
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
                                            value="{{ old('sort_order', max($profile->links->count() + 1, 1)) }}"
                                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                                            required
                                        >
                                        @error('sort_order')
                                            <p class="text-sm text-rose-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2 flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
                                        <label class="flex items-center gap-3 text-sm text-slate-600 cursor-pointer">
                                            <input type="hidden" name="is_active" value="0">
                                            <input
                                                type="checkbox"
                                                name="is_active"
                                                value="1"
                                                @checked(old('is_active', true))
                                                class="size-5 rounded-lg border-slate-300 text-[var(--color-brand-500)] focus:ring-[var(--color-brand-500)]"
                                            >
                                            <span>Langsung aktifkan link ini</span>
                                        </label>

                                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[var(--color-brand-500)] px-8 py-3.5 text-sm font-semibold text-white transition hover:bg-[var(--color-brand-600)] shadow-lg shadow-[var(--color-brand-500)]/20">
                                            Tambah Link
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </details>

                        <div id="sortable-links" class="flex flex-col gap-4">
                            @forelse ($profile->links as $link)
                                <div data-id="{{ $link->id }}" class="group relative rounded-[2rem] border border-black/5 bg-white p-5 shadow-sm transition hover:shadow-md cursor-grab active:cursor-grabbing">
                                    <div class="flex items-center justify-between gap-4">
                                        <div class="flex items-center gap-4">
                                            <div class="handle flex size-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 group-hover:bg-[var(--color-brand-50)] group-hover:text-[var(--color-brand-500)] transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/><circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/></svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-slate-900">{{ $link->title }}</h3>
                                                <p class="text-xs text-slate-500 truncate max-w-[200px] sm:max-w-xs">{{ $link->url }}</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <form method="POST" action="{{ route('links.update', $link) }}" class="flex items-center">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="title" value="{{ $link->title }}">
                                                <input type="hidden" name="url" value="{{ $link->url }}">
                                                <input type="hidden" name="is_active" value="{{ $link->is_active ? 0 : 1 }}">
                                                <button type="submit" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $link->is_active ? 'bg-emerald-500' : 'bg-slate-200' }}">
                                                    <span class="pointer-events-none inline-block size-5 translate-x-0 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $link->is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                                </button>
                                            </form>
                                            
                                            <details class="relative" x-data="{ open: false }" :open="open" @toggle="open = $event.target.open" @click.outside="open = false">
                                                <summary class="flex list-none cursor-pointer items-center justify-center p-2 rounded-xl hover:bg-slate-50 text-slate-400 hover:text-slate-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                                </summary>
                                                <div class="absolute right-0 top-full z-10 mt-2 w-48 rounded-2xl border border-black/5 bg-white p-2 shadow-xl">
                                                    <form method="POST" action="{{ route('links.destroy', $link) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="flex w-full items-center gap-2 rounded-xl px-4 py-2 text-sm text-rose-600 hover:bg-rose-50">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </details>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-[2rem] border-2 border-dashed border-slate-200 bg-white p-12 text-center">
                                    <div class="mx-auto flex size-16 items-center justify-center rounded-2xl bg-slate-50 text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                                    </div>
                                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Belum ada link</h3>
                                    <p class="mt-2 text-sm text-slate-500">Mulai dengan menambahkan link pertamamu di atas.</p>
                                </div>
                            @endforelse
                        </div>

                        <form id="reorder-form" method="POST" action="{{ route('links.reorder') }}" class="hidden">
                            @csrf
                            <div id="reorder-ids"></div>
                        </form>

                        @if ($profile->links->count() > 1)
                            <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const el = document.getElementById('sortable-links');
                                    const form = document.getElementById('reorder-form');
                                    const container = document.getElementById('reorder-ids');

                                    Sortable.create(el, {
                                        animation: 150,
                                        handle: '.handle',
                                        ghostClass: 'opacity-50',
                                        onEnd: function() {
                                            const ids = Array.from(el.children).map(child => child.dataset.id);
                                            
                                            container.innerHTML = '';
                                            ids.forEach(id => {
                                                const input = document.createElement('input');
                                                input.type = 'hidden';
                                                input.name = 'ids[]';
                                                input.value = id;
                                                container.appendChild(input);
                                            });

                                            form.submit();
                                        }
                                    });
                                });
                            </script>
                        @endif
                    </section>
                @endif

                @if ($currentTab === 'profile')
                    <article class="rounded-[2rem] border border-black/5 bg-white p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.24)] lg:p-8">
                        <div class="space-y-2">
                            <h2 class="text-2xl font-semibold text-slate-950">Edit Profil</h2>
                            <p class="text-sm leading-6 text-slate-600">
                                Perbarui identitas halaman publikmu.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-8 flex flex-col gap-8">
                            @csrf
                            @method('PUT')

                            <div class="flex flex-col gap-6 rounded-[1.5rem] bg-slate-50 p-6 sm:flex-row sm:items-center">
                                @if ($profile->avatarUrl())
                                    <img
                                        src="{{ $profile->avatarUrl() }}"
                                        alt="{{ $profile->display_name }}"
                                        class="size-24 rounded-3xl object-cover shadow-md"
                                    >
                                @else
                                    <div class="flex size-24 items-center justify-center rounded-3xl bg-white text-3xl font-semibold text-slate-800 shadow-sm">
                                        {{ $profile->initials() }}
                                    </div>
                                @endif

                                <div class="flex-1 space-y-3">
                                    <label for="avatar" class="text-sm font-medium text-slate-700">Avatar Profil</label>
                                    <input
                                        id="avatar"
                                        name="avatar"
                                        type="file"
                                        accept="image/*"
                                        class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-xl file:border-0 file:bg-[var(--color-brand-50)] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-[var(--color-brand-600)] hover:file:bg-[var(--color-brand-100)] transition"
                                    >
                                    <p class="text-xs text-slate-500">JPG, PNG atau WEBP. Maksimal 2MB.</p>
                                    @error('avatar')
                                        <p class="text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid gap-6 md:grid-cols-2">
                                <div class="flex flex-col gap-2">
                                    <label for="display_name" class="text-sm font-medium text-slate-700">Nama Tampilan</label>
                                    <input
                                        id="display_name"
                                        name="display_name"
                                        type="text"
                                        value="{{ old('display_name', $profile->display_name) }}"
                                        class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)] focus:ring-4 focus:ring-[var(--color-brand-50)]"
                                        required
                                    >
                                    @error('display_name')
                                        <p class="text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label for="theme_color" class="text-sm font-medium text-slate-700">Warna Tema (Brand Color)</label>
                                    <div class="flex items-center gap-3">
                                        <input
                                            id="theme_color"
                                            name="theme_color"
                                            type="color"
                                            value="{{ old('theme_color', $profile->theme_color) }}"
                                            class="size-11 rounded-xl border border-slate-200 bg-white p-1 cursor-pointer"
                                            required
                                        >
                                        <input
                                            type="text"
                                            value="{{ old('theme_color', $profile->theme_color) }}"
                                            oninput="document.getElementById('theme_color').value = this.value"
                                            class="flex-1 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                                            placeholder="#6366f1"
                                        >
                                    </div>
                                    @error('theme_color')
                                        <p class="text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid gap-6 md:grid-cols-2">
                                <div class="flex flex-col gap-2 md:col-span-2">
                                    <label for="slug" class="text-sm font-medium text-slate-700">Username / Slug</label>
                                    <div class="relative flex items-center">
                                        <span class="absolute left-4 text-slate-400 text-sm">/</span>
                                        <input
                                            id="slug"
                                            name="slug"
                                            type="text"
                                            value="{{ old('slug', $profile->slug) }}"
                                            class="w-full rounded-2xl border border-slate-200 bg-white pl-8 pr-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)] focus:ring-4 focus:ring-[var(--color-brand-50)]"
                                            required
                                        >
                                    </div>
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
                                    rows="4"
                                    class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)] focus:ring-4 focus:ring-[var(--color-brand-50)]"
                                    placeholder="Tuliskan sesuatu tentang dirimu..."
                                >{{ old('bio', $profile->bio) }}</textarea>
                                @error('bio')
                                    <p class="text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-slate-950 px-8 py-3.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </article>
                @endif
            </div>

            <div class="hidden lg:block">
                <div class="sticky top-8 space-y-6">
                    <div class="rounded-[2.5rem] border-[12px] border-slate-950 bg-slate-950 p-2 shadow-2xl">
                        <div class="h-[600px] overflow-hidden rounded-[1.8rem] bg-white">
                            <iframe 
                                src="{{ route('profiles.show', $profile) }}" 
                                class="h-full w-full border-0"
                                title="Preview"
                            ></iframe>
                        </div>
                    </div>
                    
                    <div class="rounded-3xl border border-black/5 bg-white p-6 shadow-sm">
                        <h4 class="font-semibold text-slate-900">Statistik Link</h4>
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs text-slate-500">Total Link</p>
                                <p class="mt-1 text-2xl font-bold text-slate-950">{{ $profile->links->count() }}</p>
                            </div>
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-xs text-slate-500">Aktif</p>
                                <p class="mt-1 text-2xl font-bold text-emerald-600">{{ $profile->links->where('is_active', true)->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.app>
