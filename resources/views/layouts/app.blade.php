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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                    Open drawer
                </label>

                <header class="bg-white shadow">
                    <div class="mx-auto py-2 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        @isset($header)
                            {{ $header }}
                        @endisset
                        <div class="self-end">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex">
                                        <div class="flex gap-4 ">
                                            <div class="w-full grow text-right">
                                                <div class="font-medium text-base text-gray-800">
                                                    {{ Auth::user()->name }}</div>
                                                <div class="font-medium text-xs text-gray-500">
                                                    {{ Auth::user()->email }}</div>
                                            </div>
                                            <picture class="shrink-0 relative">
                                                <img src="{{ Auth::user()->picture ?: 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                                    class="w-10 h-10 rounded-full" />
                                                <x-heroicon-o-chevron-down class="absolute bottom-0 right-0 w-4 h-4 text-gray-800  bg-white rounded-full p-[2px]" />
                                            </picture>
                                        </div>

                                        
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-4">
                                        <x-heroicon-o-user class="w-4 h-4" />
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')" class="flex items-center gap-4" onclick="event.preventDefault(); this.closest('form').submit();">
                                            <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4" />
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main>
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
</body>

</html>
