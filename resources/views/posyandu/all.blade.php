<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posyandu') }}
        </h2>
    </x-slot>
    <div class="">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('posyandu.partials.table')
        </div>
    </div>
</x-app-layout>
