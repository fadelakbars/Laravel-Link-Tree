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
                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                                required
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword('password')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer"
                            >
                                <svg id="eye_icon_password" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="eye_off_icon_password" class="hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" y1="2" x2="22" y2="22"/></svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="password_confirmation" class="text-sm font-medium text-slate-700">Konfirmasi Password</label>
                        <div class="relative">
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none transition focus:border-[var(--color-brand-500)]"
                                required
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword('password_confirmation')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer"
                            >
                                <svg id="eye_icon_password_confirmation" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="eye_off_icon_password_confirmation" class="hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" y1="2" x2="22" y2="22"/></svg>
                            </button>
                        </div>
                    </div>

                    <script>
                        function togglePassword(id) {
                            const input = document.getElementById(id);
                            const eyeIcon = document.getElementById('eye_icon_' + id);
                            const eyeOffIcon = document.getElementById('eye_off_icon_' + id);
                            
                            if (input.type === 'password') {
                                input.type = 'text';
                                eyeIcon.classList.add('hidden');
                                eyeOffIcon.classList.remove('hidden');
                            } else {
                                input.type = 'password';
                                eyeIcon.classList.remove('hidden');
                                eyeOffIcon.classList.add('hidden');
                            }
                        }
                    </script>

                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[var(--color-brand-500)] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[var(--color-brand-600)] cursor-pointer">
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
