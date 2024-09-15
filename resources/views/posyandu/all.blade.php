<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posyandu') }}
        </h2>
    </x-slot>
    <div class="h-full">
        <div class="max-w-full sm:px-6 lg:p-8 bg-white shadow h-full">
            @include('posyandu.partials.table')
        </div>
    </div>
</x-app-layout>
