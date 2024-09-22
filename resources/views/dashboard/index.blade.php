<x-app-layout>
    <div class="p-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p>
            {{ __('General information about the activity') }}
        </p>
    </div>
    <div class="px-8 flex flex-row gap-8">
        <div class="mx-auto grow flex gap-8 w-full">
            @include('dashboard.partials.chart')
            @include('dashboard.partials.news')
        </div>
        <div class="shrink-0">
            @include('dashboard.partials.calendar')
        </div>
    </div>
</x-app-layout>
