<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Styles --}}
    <link rel="stylesheet" href="/css/notify.css">
    @stack('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content min-h-screen flex flex-col">
                <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                    Open drawer
                </label>

                @isset($header)
                    <header class="bg-white shadow">
                        <div class="mx-auto py-2 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="grow">
                    {{ $slot }}
                </main>
            </div>
            <div class="drawer-side">
                <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
                <div class="bg-white border h-screen w-56">
                    <x-sidebar />
                </div>
            </div>
        </div>

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
    @stack('scripts')
</body>

</html>
