<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Golden Drip') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    
    {{-- 3. FLEX LAYOUT (Keeps footer at the bottom) --}}
    <body class="font-sans antialiased bg-[#FDF8F6] flex flex-col min-h-screen">
        
        <x-banner />

        {{-- 4. YOUR NEW HEADER --}}
        <x-header />

        {{-- PAGE HEADER SLOT (Restored for Profile/Dashboard Headers) --}}
        @if (isset($header))
            <header class="bg-white shadow">
                {{ $header }}
            </header>
        @endif

        {{-- 5. MAIN CONTENT (Expands to fill space) --}}
        <main class="flex-grow">
            {{ $slot }}
        </main>

        {{-- 6. YOUR NEW FOOTER --}}
        <x-footer />

        @stack('modals')
        @livewireScripts
    </body>
</html>