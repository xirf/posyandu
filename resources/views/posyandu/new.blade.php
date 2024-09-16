@php
    $menus = [__('Infant'), __('Child'), __('Teenager'), __('Adult'), __('Elderly')];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Record') }}
        </h2>
    </x-slot>
    <div class="bg-white rounded-lg m-4 border shadow p-8 space-y-4" x-data="{ openedTab: 'infant', }">
        <div class="w-full border-b">
            <div role="tablist" class="tabs grid grid-cols-5 w-fit relative">
                @foreach ($menus as $menu)
                    <div role="tab" class="tab" @click="openedTab = '{{ Str::lower($menu) }}'">{{ $menu }}
                    </div>
                @endforeach
                <div class="absolute -bottom-[1px] h-[2px] bg-cyan-500 w-1/5 transition-all duration-300 ease-in-out"
                    x-bind:style="{ left: (['infant', 'child', 'teenager', 'adult', 'elderly'].indexOf(openedTab) * 20) + '%' }">
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-xl font-bold">{{ __('Patient Information') }}</h2>
            <p class="text-xs text-gray-500">
                {{ __("Select or add from name, you can also update the patient's information") }}</p>
            <div class="gap-4 gap-y-2 grid grid-cols-5 mt-2">
                @include('posyandu.partials.new.patient')
            </div>
        </div>
        <div>
            <h2 class="text-xl font-bold">{{ __('Vital Information') }}</h2>
            <div class="gap-4 grid grid-cols-5 mt-2">
                @include('posyandu.partials.new.vital')
            </div>
        </div>
        <div>
            <h2 class="text-xl font-bold">{{ __('Lab Results') }}</h2>
            <div class="gap-4 grid grid-cols-5 mt-2">
                @include('posyandu.partials.new.lab')
            </div>
        </div>
        <div>
            <h2 class="text-xl font-bold">{{ __('Medical History') }}</h2>
            <div class="gap-4 grid grid-cols-5 mt-2">
                @include('posyandu.partials.new.history')
            </div>
        </div>
        <div>
            <div class="w-fit">
                <div class="block mt-4">
                    <label for="kb" class="inline-flex items-center">
                        <input id="kb" type="checkbox"
                            class="rounded border-gray-300 text-cyan-600 shadow-sm focus:ring-cyan-500" name="kb">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Family Planning') }}</span>
                    </label>
                </div>
                <x-input-error :messages="$errors->createReport->get('kb')" class="mt-2" />
            </div>
        </div>
        <div class="flex w-fit">
            <x-secondary-button class="mt-4 mr-4">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-primary-button class="mt-4">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </div>
</x-app-layout>
