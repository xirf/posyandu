@php
    $menus = [__('All'), __('Infant'), __('Child'), __('Teenager'), __('Adult'), __('Elderly')];
@endphp

<div class="w-full h-full flex flex-col">
    <div class="w-full flex z-50 justify-between">
        <div class="flex gap-4">
            <div x-data="{ isOpen: false, openedWithKeyboard: false, selected: '{{ $menus[0] }}' }" class="relative" @keydown.esc.window="isOpen = false, openedWithKeyboard = false">
                <!-- Toggle Button -->
                <button type="button" @click="isOpen = ! isOpen"
                    class="inline-flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-md border border-neutral-300 bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-800 dark:border-neutral-700 dark:bg-neutral-900 dark:focus-visible:outline-neutral-300"
                    aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true"
                    @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true"
                    :class="isOpen || openedWithKeyboard ? 'text-neutral-900 dark:text-white' :
                        'text-neutral-600 dark:text-neutral-300'"
                    :aria-expanded="isOpen || openedWithKeyboard">
                    <span x-text="selected"></span>
                    <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" class="size-4 rotate-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <!-- Dropdown Menu -->
                <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard"
                    @click.outside="isOpen = false, openedWithKeyboard = false"
                    @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()"
                    class="absolute top-11 left-0 flex min-w-[12rem] flex-col overflow-hidden rounded-md border border-neutral-300 bg-neutral-50 py-1.5 w-fit z-999"
                    role="menu">
                    @foreach ($menus as $menu)
                        <button
                            class="bg-neutral-50 px-4 text-left py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/10 focus-visible:text-neutral-900 focus-visible:outline-none"
                            role="menuitem"
                            @click="isOpen = false, selected = '{{ $menu }}', openedWithKeyboard = false">
                            {{ $menu }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="relative flex w-full max-w-xs flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="absolute left-2.5 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50 dark:text-neutral-300/50"> 
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input type="search" class="w-full rounded-md border border-neutral-300 bg-neutral-50 py-2 pl-10 pr-2 text-sm focus:border-cyan-500 focus:ring-cyan-500  
                " name="search" placeholder="{{__("Search...")}}" aria-label="{{__("Search...")}}"/>
            </div>
        </div>
        <x-primary-button>Add</x-primary-button>
    </div>

    <div class="w-full overflow-auto grow border rounded-md mt-6">
        <table class="table table-zebra w-full table-xs">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-8">{{ __('No') }}</th>
                    <th><span>{{ __('Patient') }}</span></th>
                    <th><span>{{ __('Address') }}</span></th>
                    <th><span class="tooltip tooltip-bottom" data-tip="{{ __('Height') }}">{{ __('TB') }}</span>
                    </th>
                    <th><span class="tooltip tooltip-bottom" data-tip="{{ __('Weight') }}">{{ __('BB') }}</span>
                    </th>
                    <th><span class="tooltip tooltip-bottom"
                            data-tip="{{ __('Head Circumference') }}">{{ __('LK') }}</span></th>
                    <th><span class="tooltip tooltip-bottom"
                            data-tip="{{ __('Upper Arm Circumference') }}">{{ __('LILA') }}</span></th>
                    <th><span class="tooltip tooltip-bottom"
                            data-tip="{{ __('Abdominal Circumference') }}">{{ __('LP') }}</span></th>
                    <th><span>{{ __('Cholesterol') }}</span></th>
                    <th><span>{{ __('LAB') }}</span></th>
                    <th><span>{{ __('Complaints') }}</span></th>
                    <th><span>{{ __('Diagnosic') }}</span></th>
                    <th><span>{{ __('Disease') }}</span></th>
                    <th><span>{{ __('Medication') }}</span></th>
                    <th><span>{{ __('Action') }}</span></th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <div class="grid">
                            <h3 class="text-sm font-bold">[[name]]</h3>
                            <div class="flex flex-wrap items-center gap-1 text-gray-400">
                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                <div>[[place-of-birth]] &middot; [[birthdate]]</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="grid">
                            <div>[[dukuh]]</div>
                            <div class="text-gray-400">RT [[rt]] RW [[rw]]</div>
                        </div>
                    </td>
                    <td>[[tb]]</td>
                    <td>[[bb]]</td>
                    <td>[[lk]]</td>
                    <td>[[lila]]</td>
                    <td>[lp]</td>
                    <td>[chl]</td>
                    <td>
                        <div class="grid">
                            <div class="">Hemoglobin: [[hb]]</div>
                            <div class="">GDA: [[gda]]</div>
                            <div class="">UA: [[gda]]</div>
                        </div>
                    </td>
                    <td>[[compaint]]</td>
                    <td>[[diagnosic]]</td>
                    <td>[[disease]]</td>
                    <td>[[medication]]</td>
                    <td>
                        <a href="" class="text-blue-500 hover:underline">Edit</a>
                        <a href="" class="text-red-500 hover:underline">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
