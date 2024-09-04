<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between flex-wrap">
            {{ __('Add News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-8  items-start">
            <div class="grow space-y-4">
                @include('news.partials.title-editor')
                @include('news.partials.quill-editor')
            </div>

            <div class="w-full max-w-md space-y-4">
                @include('news.partials.sidebar')
                @include('news.partials.seo')

            </div>
        </div>
    </div>
</x-app-layout>
