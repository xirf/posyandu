<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between flex-wrap">
            {{ __('News') }}
            <a href="{{ route('dashboard.news.new') }}">
                <x-primary-button>{{ __('Add New') }}</x-primary-button>
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
        </div>
    </div>
</x-app-layout>
