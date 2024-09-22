@php
    $menus = [
        [
            'dashboard',
            'Beranda',
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 9.429V5a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v8.286m6-3.857V21m0-11.571h4a2 2 0 0 1 2 2V19a2 2 0 0 1-2 2h-4m0 0H9m0 0v-7.714M9 21H5a2 2 0 0 1-2-2v-3.714a2 2 0 0 1 2-2h4"/></svg>',
        ],
        [
            'dashboard.news',
            'Berita',
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.478 3H7.25A2.25 2.25 0 0 0 5 5.25v13.5A2.25 2.25 0 0 0 7.25 21h9a2.25 2.25 0 0 0 2.25-2.25V12M9.478 3c1.243 0 2.272 1.007 2.272 2.25V7.5A2.25 2.25 0 0 0 14 9.75h2.25A2.25 2.25 0 0 1 18.5 12M9.478 3c3.69 0 9.022 5.36 9.022 9M9 16.5h6m-6-3h4"/></svg>',
        ],
        [
            'dashboard.activity',
            'Kegiatan',
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path stroke-miterlimit="10" d="M8.308 21h7.384c3.71 0 4.375-1.45 4.569-3.213l.692-7.2c.25-2.196-.397-3.987-4.338-3.987h-9.23c-3.941 0-4.587 1.791-4.338 3.987l.692 7.2C3.933 19.55 4.598 21 8.308 21m0-14.4v-.72c0-1.593 0-2.88 2.954-2.88h1.476c2.954 0 2.954 1.287 2.954 2.88v.72"/><path stroke-miterlimit="10" d="M9.812 13.331A15.26 15.26 0 0 1 3.234 11m11 2.331A15.26 15.26 0 0 0 20.812 11"/><circle cx="12" cy="13.5" r="2"/></g></svg>',
        ],
        [
            'dashboard.posyandu',
            'Posyandu',
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 3.5C5.127 3.5 3 5.76 3 8.547C3 14.125 12 20.5 12 20.5s9-6.375 9-11.953C21 5.094 18.873 3.5 16.25 3.5c-1.86 0-3.47 1.136-4.25 2.79c-.78-1.654-2.39-2.79-4.25-2.79"/></svg>',
        ],
        // [
        //     'dashboard.users',
        //     'Pengguna',
        //     '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 19.5c0-1.657-2.239-3-5-3s-5 1.343-5 3m14-3c0-1.23-1.234-2.287-3-2.75M3 16.5c0-1.23 1.234-2.287 3-2.75m12-4.014a3 3 0 1 0-4-4.472M6 9.736a3 3 0 0 1 4-4.472m2 8.236a3 3 0 1 1 0-6a3 3 0 0 1 0 6"/></svg>',
        // ],
        [
            'dashboard.site-info',
            'Lainnya',
            ' <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="1" stroke-width="1.5"><path d="M10.11 3.9a1 1 0 0 1 .995-.9h1.79a1 1 0 0 1 .995.9l.033.333a8 8 0 0 1 2.209.915l.259-.212a1 1 0 0 1 1.34.067l1.266 1.266a1 1 0 0 1 .067 1.34l-.212.26c.409.676.72 1.419.915 2.208l.332.033a1 1 0 0 1 .901.995v1.79a1 1 0 0 1-.9.995l-.333.033a8 8 0 0 1-.915 2.209l.212.259a1 1 0 0 1-.067 1.34l-1.266 1.266a1 1 0 0 1-1.34.067l-.26-.212a8 8 0 0 1-2.208.915l-.033.332a1 1 0 0 1-.995.901h-1.79a1 1 0 0 1-.995-.9l-.033-.333a8 8 0 0 1-2.209-.915l-.259.212a1 1 0 0 1-1.34-.067L5.003 17.73a1 1 0 0 1-.067-1.34l.212-.26a8 8 0 0 1-.915-2.208L3.9 13.89a1 1 0 0 1-.9-.995v-1.79a1 1 0 0 1 .9-.995l.333-.033a8 8 0 0 1 .915-2.209l-.212-.259a1 1 0 0 1 .067-1.34L6.27 5.003a1 1 0 0 1 1.34-.067l.26.212a8 8 0 0 1 2.208-.915z"/><circle cx="2.5" cy="2.5" r="2.5" transform="matrix(1 0 0 -1 9.5 14.5)"/></g></svg>',
        ],
    ];
@endphp

<div class="w-full h-full flex flex-col">
    <div class="shrink-0 flex items-center p-4">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
    </div>
    <ul class="grow menu py-6">
        @foreach ($menus as $item)
            <li>
                <a href="{{ route($item[0]) }}"
                    class="flex items-center gap-4 py-2 px-4 {{ request()->routeIs($item[0]) ? 'bg-cyan-500 text-white hover:bg-cyan-500' : 'text-gray-600 hover:text-gray-800' }}">
                    {!! $item[2] !!}
                    <span>{{ $item[1] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="shrink-0 flex flex-col gap-4 p-4">
        <div
            class="flex items-center gap-4 py-2 px-4 text-gray-600 hover:text-gray-800 border border-gray-300 rounded-md">
            <img src="{{ auth()->user()->picture }}" alt="{{ auth()->user()->name }}"
                class="w-10 h-10 rounded-full object-cover overflow-hidden border shrink-0">
            <span class="font-bold overflow-hidden line-clamp-2">{{ auth()->user()->name }}asdad asd a das d</span>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('profile.edit') }}">
                <x-secondary-button class="w-full justify-center">
                    <x-heroicon-o-pencil-square width="24" height="24" />
                </x-secondary-button>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-secondary-button class="w-full flex justify-center"
                    onclick="event.preventDefault();
                        this.closest('form').submit();">
                    <x-heroicon-o-arrow-right-on-rectangle width="24" height="24" />
                </x-secondary-button>
                </a>
            </form>
        </div>
    </div>
</div>
