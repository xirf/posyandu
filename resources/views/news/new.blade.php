<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between flex-wrap">
            {{ __('Add News') }}
        </h2>
    </x-slot>

    <form class="py-12" action="{{ route('dashboard.news.store') }}" id="news-form" method="POST">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-8  items-start">
            <div class="grow space-y-4">
                <div class="p-4 bg-white shadow sm:rounded-lg space-y-4" x-data="{ permalink: '', overflow: false, siteNewsPath: '{{ route('dashboard') }}' }">
                    <x-text-input class="w-full" placeholder="{{ __('Title') }}" name="title" id="title"
                        required autofocus
                        @input=" permalink = siteNewsPath + '/' + $event.target.value.trim().replace(/ /g, '-').replace(/[^\w-]/g, '').substring(0, 100);
                                 overflow = $event.target.value.length > 100">
                    </x-text-input>
                    <div class="text-sm text-gray-500">
                        <p>
                            {{ __('Permalink: ') }} <span x-text="permalink"></span>
                        </p>
                        <p x-show="overflow" class="text-red-500">
                            Judul terlalu panjang, url akan disingkat
                        </p>
                        <input type="text" name="permalink" id="permalink" :value="permalink"
                            class="border border-gray-300 rounded-md w-full hidden" readonly>
                    </div>

                    <x-quill name="body" value="" placeholder="Content here..." :endpoint="'/uploads'"
                        :formId="'news-form'" />
                </div>
            </div>

            <div class="w-full max-w-md space-y-4">
                @include('news.partials.sidebar')
            </div>
        </div>
    </form>
</x-app-layout>
