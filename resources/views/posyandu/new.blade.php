@php
    $menus = [
        ['infant', __('Infant')],
        ['child', __('Child')],
        ['teenager', __('Teenager')],
        ['adult', __('Adult')],
        ['elderly', __('Elderly')],
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Record') }}
        </h2>
    </x-slot>
    <form class="bg-white max-w-7xl mx-auto rounded-lg m-4 border shadow p-8 space-y-4" x-data="{ openedTab: '{{ $menus[0][0] }}', openedIndex: 0 }" id="addNewRecordForm">
        <div class="w-full border-b">
            <div role="tablist" class="tabs grid grid-cols-5 w-fit relative">
                @foreach ($menus as $menu)
                    <div role="tab" class="tab"
                        @click="openedTab = '{{ $menu[0] }}', openedIndex = {{ $loop->index }}">
                        {{ __($menu[1]) }}
                    </div>
                @endforeach
                <div class="absolute -bottom-[1px] h-[2px] bg-cyan-500 w-1/5 transition-all duration-300 ease-in-out"
                    x-bind:style="{ left: (openedIndex * 20) + '%' }">
                </div>
            </div>
        </div>
        <input type="text" class="hidden" x-bind:value="openedTab" name="age_group">
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
        <div class="overflow-y-hidden transition-all duration-500 ease-in-out origin-top"
            x-bind:class="{
                'max-h-0': openedIndex <= 1,
                'max-h-36': openedIndex > 1
            }">
            <h2 class="text-xl font-bold">{{ __('Lab Results') }}</h2>
            <div class="gap-4 grid grid-cols-5 mt-2">
                @include('posyandu.partials.new.lab')
            </div>
        </div>
        <div class="overflow-y-hidden transition-all duration-500 ease-in-out origin-top"
            x-bind:class="{
                'max-h-0': openedIndex <= 2,
                'max-h-60': openedIndex > 2
            }">
            <h2 class="text-xl font-bold">{{ __('Medical History') }}</h2>
            <div class="gap-4 grid grid-cols-5 mt-2">
                @include('posyandu.partials.new.history')
            </div>

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
            <x-secondary-button class="mt-4 mr-4" type="button">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-primary-button class="mt-4" type="submit">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>

    @pushOnce('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('addNewRecordForm');
                console.log("LODED")
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    console.log("SUBMITED")
                    const formData = new FormData(form);
                    const url = '{{ route('posyandu.store') }}';

                    axios.post(url, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            const data = response.data;
                            notyf.success("{{ __('Record saved') }}")
                            // clear form
                            form.reset();
                        })
                        .catch(error => {
                            if (error.response.data.errors) {
                                const errors = error.response.data.errors;
                                const keys = Object.keys(errors);
                                console.log(keys)
                                keys.forEach(key => {
                                    console.log(key)
                                    const input = form.querySelector(`[name="${key}"]`);
                                    const error = errors[key];
                                    if (input) {
                                        input.classList.add('border-red-500');
                                        const errorElement = document.createElement('p');
                                        errorElement.classList.add('text-red-500', 'text-xs',
                                            'mt-1');
                                        errorElement.textContent = error;
                                        const parent = input.parentElement;
                                        parent.appendChild(errorElement);
                                    }
                                })
                            } else {
                                notyf.error("{{ __('Failed to save record') }}")
                            }
                        });
                });
            });

            // get all input element and listen if changed remove the error
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    this.classList.remove('border-red-500');
                    const parent = this.parentElement;
                    const errorElement = parent.querySelector('.text-red-500');
                    if (errorElement) {
                        errorElement.remove();
                    }
                });
            });
        </script>
    @endPushOnce
</x-app-layout>
