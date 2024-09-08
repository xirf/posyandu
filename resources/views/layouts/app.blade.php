<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- for push sty;e --}}

    <link rel="stylesheet" href="/css/notify.css">
    @stack('style')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
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
    @stack('script')
</body>

</html>
