<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistema SST') }}</title>

    <!-- Inter — fuente enterprise premium -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tom Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <div class="app-shell" x-data="{ sidebarCollapsed: false, mobileOpen: false }">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Mobile overlay --}}
        <div
            x-show="mobileOpen"
            x-transition:enter="transition-opacity ease duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="mobileOpen = false"
            class="fixed inset-0 bg-slate-900/50 z-[250] md:hidden"
            style="display:none"></div>

        {{-- Main area --}}
        <div class="sst-main" :class="{ 'expanded': sidebarCollapsed }">

            {{-- Top bar --}}
            @include('layouts.topbar')

            {{-- Page content --}}
            <main class="sst-content">
                @isset($header)
                <div class="page-header">
                    {{ $header }}
                </div>
                @endisset
                {{ $slot }}
            </main>

            {{-- Footer --}}
            <footer class="sst-footer">
                <span>
                    &copy; {{ date('Y') }} Desarrollado por <strong>Oscar Dev</strong>
                    &nbsp;&middot;&nbsp;
                    <a href="https://github.com/theoscar1210" target="_blank" rel="noopener">
                        <i class="bi bi-github"></i> GitHub
                    </a>
                    &nbsp;&middot;&nbsp;
                    <a href="mailto:oscardfer2020@gmail.com">oscardfer2020@gmail.com</a>
                </span>
            </footer>

        </div>

    </div>

</body>

</html>