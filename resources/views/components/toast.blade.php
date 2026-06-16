@if (session('status'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 5000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-4"
        class="fixed bottom-8 left-1/2 z-50 -translate-x-1/2 sm:left-auto sm:right-8 sm:translate-x-0"
    >
        <div class="flex min-w-[320px] items-center gap-4 rounded-[1.5rem] border border-white/60 bg-white/90 p-4 shadow-[0_24px_48px_-12px_rgba(15,23,42,0.25)] backdrop-blur-xl">
            <div class="flex size-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            
            <div class="flex-1 pr-4">
                <p class="text-sm font-semibold text-slate-900">Berhasil!</p>
                <p class="text-xs font-medium text-slate-500">{{ session('status') }}</p>
            </div>

            <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
@endif
