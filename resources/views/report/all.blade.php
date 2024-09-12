<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Posyandu') }}
            </h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('dashboard.report.new') }}">
                    <x-secondary-button>{{ __('Export Data') }}</x-secondary-button>
                </a>
                <a href="{{ route('dashboard.report.new') }}">
                    <x-primary-button>{{ __('Insert Data') }}</x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>
    <div class="">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('report.partials.table')
        </div>
    </div>
</x-app-layout>
