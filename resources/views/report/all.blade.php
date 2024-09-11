<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between flex-wrap">
            {{ __('Posyandu') }}
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('dashboard.report.new') }}">
                    <x-secondary-button>{{ __('Export Data') }}</x-secondary-button>
                </a>
                <a href="{{ route('dashboard.report.new') }}">
                    <x-primary-button>{{ __('Insert Data') }}</x-primary-button>
                </a>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        </div>
    </div>
</x-app-layout>
