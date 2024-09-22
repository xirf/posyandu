<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/favicon.ico')" type="image/x-icon">

    <title>{{ $siteInfo->name ?? config('app.name', 'Posyandu Bareng') }} {{ $title ?? '' }} </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />

    {{-- Styles --}}
    <link rel="stylesheet" href="/css/notify.css">
    @stack('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#fcfdfd] overflow-x-hidden w-screen ">
        <div class="relative z-50">
            <x-navbar />
        </div>
        <main class="grow relative z-0">
            {{ $slot }}
        </main>
    </div>
    <footer class="min-h-32 overflow-x-hidden w-screen ">
        <x-footer />
    </footer>
    <script src="/js/notify.js"></script>
    <script>
        var notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top'
            },
            duration: 5000,
            types: [,
                {
                    type: 'error',
                    background: '#f87171',
                    dismissible: true
                },
                {
                    type: 'success',
                    background: '#34d399',
                    dismissible: true
                }
            ]
        });
    </script>
    @stack('modals')
    @stack('scripts')
</body>

</html>
