<x-layouts.app title="Manajemen Pengguna">
    <main class="mx-auto flex min-h-screen max-w-6xl flex-col gap-8 px-6 py-8 lg:px-10">
        <header class="flex flex-col gap-6 rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.3)] backdrop-blur lg:p-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-1">
                    <p class="text-sm font-medium text-[var(--color-brand-600)]">Admin Area</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-950">Manajemen Pengguna</h1>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50 cursor-pointer">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 cursor-pointer">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <section class="rounded-[2rem] border border-black/5 bg-white p-6 shadow-[0_24px_80px_-40px_rgba(15,23,42,0.24)] lg:p-8 space-y-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-xl font-bold text-slate-900">Daftar Pengguna</h2>
                
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center gap-2 w-full sm:max-w-xs">
                    <div class="relative flex-1">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Cari nama atau email..."
                            class="w-full rounded-2xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                        >
                        @if(request('search'))
                            <a href="{{ route('admin.users.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </a>
                        @endif
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center size-10 rounded-2xl bg-slate-950 text-white hover:bg-slate-800 transition cursor-pointer shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto -mx-6 lg:-mx-8">
                <div class="inline-block min-w-full align-middle px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-xs font-bold uppercase tracking-wider text-slate-400 sm:pl-0">Nama</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Email</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Profil</th>
                                <th scope="col" class="px-3 py-3.5 class-3 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Terdaftar</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-xs font-bold uppercase tracking-wider text-slate-400">Link</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-xs font-bold uppercase tracking-wider text-slate-400">Peran</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0 text-right text-xs font-bold uppercase tracking-wider text-slate-400">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($users as $u)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-slate-900 sm:pl-0">
                                        {{ $u->name }}
                                        @if ($u->id === auth()->id())
                                            <span class="ml-1.5 inline-flex items-center rounded-md bg-blue-50 px-1.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Anda</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">{{ $u->email }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        @if ($u->profile)
                                            <a href="{{ route('profiles.show', $u->profile) }}" target="_blank" class="inline-flex items-center gap-1 text-[var(--color-brand-600)] hover:text-[var(--color-brand-700)] font-semibold transition cursor-pointer">
                                                /{{ $u->profile->slug }}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                            </a>
                                        @else
                                            <span class="text-slate-400">Belum dibuat</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">{{ $u->created_at->format('d M Y') }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-center font-semibold text-slate-600">
                                        {{ $u->profile ? $u->profile->links_count : 0 }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-center">
                                        @if ($u->id === auth()->id())
                                            <span class="inline-flex items-center rounded-xl bg-purple-50 px-3 py-1 text-xs font-semibold text-purple-700 border border-purple-200">
                                                Admin
                                            </span>
                                        @else
                                            <form method="POST" action="{{ route('admin.users.toggle-admin', $u) }}" class="inline-block">
                                                @csrf
                                                <button 
                                                    type="submit" 
                                                    class="inline-flex items-center rounded-xl px-3 py-1 text-xs font-semibold transition cursor-pointer active:scale-95 border {{ $u->is_admin ? 'bg-purple-50 text-purple-700 border-purple-200 hover:bg-purple-100' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}"
                                                    title="Klik untuk mengubah peran pengguna"
                                                >
                                                    {{ $u->is_admin ? 'Admin' : 'User' }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        @if ($u->id === auth()->id())
                                            <span class="text-xs text-slate-400 italic">Terkunci</span>
                                        @else
                                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Semua data profil dan link miliknya akan dihapus secara permanen.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 text-rose-600 hover:text-rose-800 font-semibold transition cursor-pointer active:scale-95">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-sm font-medium text-slate-500">
                                        Tidak ada pengguna ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pt-4">
                {{ $users->links() }}
            </div>
        </section>
    </main>
</x-layouts.app>
