<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? config('app.name', 'Laravel Link Tree') }}</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        <div class="min-h-screen bg-linear-to-b from-white via-[var(--color-surface-50)] to-[var(--color-brand-50)]">
            {{ $slot }}
        </div>
    </body>
</html>
