<x-layouts.app title="Masuk">
    <main class="mx-auto flex min-h-screen max-w-6xl items-center justify-center px-6 py-12">
        <x-auth-card>
            <div class="space-y-6">
                <div class="space-y-2 text-center">
                    <p class="text-sm font-medium text-[var(--color-brand-600)]">Dashboard</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-950">Masuk ke akunmu</h1>
                    <p class="text-sm leading-6 text-slate-500">
                        Gunakan email dan password untuk mengelola halaman link tree.
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf

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

                    <label class="flex items-center gap-3 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="size-4 rounded border-slate-300 text-[var(--color-brand-500)]">
                        <span>Ingat saya</span>
                    </label>

                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[var(--color-brand-500)] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[var(--color-brand-600)]">
                        Masuk
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-slate-900">Daftar sekarang</a>
                </p>
            </div>
        </x-auth-card>
    </main>
</x-layouts.app>
