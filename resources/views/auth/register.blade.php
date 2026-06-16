<x-layouts.app title="Daftar">
    <main class="mx-auto flex min-h-screen max-w-6xl items-center justify-center px-6 py-12">
        <x-auth-card>
            <div class="space-y-6">
                <div class="space-y-2 text-center">
                    <p class="text-sm font-medium text-[var(--color-brand-600)]">Mulai</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-950">Buat akun baru</h1>
                    <p class="text-sm leading-6 text-slate-500">
                        Akun baru akan langsung mendapat satu profil publik sebagai fondasi link tree.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-sm font-medium text-slate-700">Nama</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[var(--color-brand-500)]"
                            required
                        >
                        @error('name')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-sm font-medium text-slate-700">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[var(--color-brand-500)]"
                            required
                        >
                        @error('email')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="password" class="text-sm font-medium text-slate-700">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                            required
                        >
                        @error('password')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="password_confirmation" class="text-sm font-medium text-slate-700">Konfirmasi Password</label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                            required
                        >
                    </div>

                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[var(--color-brand-500)] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[var(--color-brand-600)]">
                        Daftar
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-slate-900">Masuk</a>
                </p>
            </div>
        </x-auth-card>
    </main>
</x-layouts.app>
