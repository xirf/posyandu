@php
    $year = now()->year;
    $month = now()->format('m');
@endphp

<div x-data="{
    isOpened: false,
    openedWithKeyboard: false,
    year1: {{ $year }},
    year2: {{ $year }},
    month: {{ $month }},
}" @keydown.esc.window="isOpened = false, openedWithKeyboard = false" class="relative">
    <!-- Toggle Button -->
    <button type="button" @click="isOpened = ! isOpened" @keydown.space.prevent="openedWithKeyboard = true"
        @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true"
        class="inline-flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-md border border-neutral-300 bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-800 "
        :class="isOpened || openedWithKeyboard ? 'text-neutral-900 ' : 'text-neutral-600'"
        :aria-expanded="isOpened || openedWithKeyboard" aria-haspopup="true">
        {{ __('Export') }}
        <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" class="h-4 w-4 rotate-0">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>
    <!-- Dropdown Menu -->
    <div x-cloak x-show="isOpened || openedWithKeyboard" x-transition x-trap="openedWithKeyboard"
        @click.outside="isOpened = false, openedWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()"
        @keydown.up.prevent="$focus.wrap().previous()"
        class="absolute top-11 right-0 flex min-w-[12rem] flex-col divide-y divide-neutral-300 overflow-hidden rounded-md border border-neutral-300 bg-neutral-50"
        role="menu">
        <div class="flex flex-col py-1.5 px-4">
            <h5 class="font-bold bg-neutral-50 py-2">Per Tahun</h5>
            <div class="gap-4 w-52 grid grid-cols-3">
                <x-text-input :value="$year" x-model="year1" class="col-span-2" />
                <a x-bind:href="`{{ route('dashboard.medical-record.export.yearly', '') }}/${year1}`" href="#" target="_blank" class="w-full h-full">
                    <x-primary-button>
                        <x-heroicon-o-cloud-arrow-down class="w-6 h-6" />
                    </x-primary-button>
                </a>
            </div>
        </div>
        <div class="flex flex-col py-1.5 px-4">
            <h5 class="font-bold bg-neutral-50 py-2">Per Bulan</h5>
            <div class="grid grid-cols-3 gap-4 w-52">
                <div class="grid grid-cols-2 gap-2 col-span-2 w-full">
                    <x-text-input :value="$year" x-model="year2" />
                    <x-text-input :value="$month" x-model="month" />
                </div>
                <a x-bind:href="`{{ route('dashboard.medical-record.export.yearly', '') }}/${year2}/${month}`" target="_blank" class="w-full h-full">
                    <x-primary-button>
                        <x-heroicon-o-cloud-arrow-down class="w-6 h-6" />
                    </x-primary-button>
                </a>
            </div>
        </div>
    </div>
</div>
