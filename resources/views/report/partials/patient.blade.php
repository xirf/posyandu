@pushOnce('style')
    <link rel="stylesheet" href="/css/tom-select.css">
    <style>
        .icon {
            width: 3rem;
        }

        .ts-wrapper.loading {
            aspect-ratio: unset;
            -webkit-mask-image: none;
            mask-image: none;
        }

        .ts-control:has(input:focus) {
            border-color: rgb(6 182 212);
            outline-style: solid;
            outline-width: 1px;
            outline-color: rgb(6 182 212);
        }
    </style>
@endPushOnce

<div class="w-full h-full p-4">
    <h3 class="block mb-1 text-lg font-semibold text-gray-700">{{ __('Patient Information') }}</h3>
    <div class="grid gap-4">
        <div>
            <x-input-label for="name" :value="__('Name')" required />
            <select id="select-patient" name="name" class="mt-1 block w-full" required></select>
            <x-input-error :messages="$errors->createReport->get('nama')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="nik" :value="__('NIK')" />
            <x-text-input id="nik" name="nik" type="number" class="mt-1 block w-full"
                placeholder="{{ __('Insert NIK') }}" />
            <x-input-error :messages="$errors->createReport->get('nik')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="gender" :value="__('Gender')" required />
            <select id="gender" name="gender"
                class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm"
                placeholder="{{ __('Choose Gender') }}" required>
                <option value="male">{{ __('Male') }}</option>
                <option value="female">{{ __('Female') }}</option>
            </select>
            <x-input-error :messages="$errors->createReport->get('gender')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="place_of_birth" :value="__('Place Of Birth')" />
            <x-text-input id="place_of_birth" name="place_of_birth" type="text" class="mt-1 block w-full"
                placeholder="{{ __('Place Of Birth') }}" />
            <x-input-error :messages="$errors->createReport->get('place_of_birth')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="birth_date" :value="__('Birth Date')" />
            <x-text-input id="birth_date" name="birth_date" type="text" class="mt-1 block w-full"
                placeholder="{{ __('Birth Date') }}" />
            <x-input-error :messages="$errors->createReport->get('birth_date')" class="mt-2" />
        </div>
    </div>
</div>

@pushOnce('script')
    <script src="/js/tom-select.js" defer></script>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            initTomSelect();
        });

        function initTomSelect() {
            const tomSelect = new TomSelect('#select-patient', {
                valueField: 'name',
                labelField: 'name',
                searchField: 'name',
                placeholder: '{{ __('Search patient...') }}',
                create: true,
                multiple: false,
                load: function(query, callback) {
                    var url = '{{ route('api.patients') }}?name=' + encodeURIComponent(query);
                    fetch(url, {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(json => {
                            if (Array.isArray(json)) {
                                callback(json);
                            } else {
                                console.error('Expected an array but got:', json);
                                callback();
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            callback();
                        });
                },
                render: {
                    option: function(item, escape) {
                        const genderClass = escape(item.gender) === 'male' ? 'bg-blue-500' : 'bg-pink-500';
                        const genderText = escape(item.gender) === 'male' ? "L" : "P";
                        const unknownText = '{{ __('Unknown') }}';

                        const place = item.place_of_birth || unknownText;
                        const date = item.birth_date || unknownText;

                        return `<div class="py-2 flex flex-col">
                                    <p class="h5">
                                        ${escape(item.name)} 
                                        <span class="${genderClass} text-white text-xs rounded-full px-2">${genderText}</span>
                                    </p>
                                    <div class="text-xs text-gray-500 grid grid-cols-5">
                                        <div class="col-span-1">NIK</div> 
                                        <div class="col-span-4">: ${escape(item.nik) || unknownText}</div>
                                        <div class="col-span-1">Alamat</div> 
                                        <div class="col-span-4">: ${escape(item.address) || unknownText}</div>
                                        <div class="col-span-1">TTL</div> 
                                        <div class="col-span-4">: ${escape(item.place_of_birth) || unknownText} - ${escape(item.birth_date) || unknownText}</div>
                                    </div>
                                </div>`;
                    },
                    item: function(selectedItem, escape) {
                        document.getElementById('nik').value = selectedItem.nik || '';
                        document.getElementById('gender').value = selectedItem.gender || '';
                        document.getElementById('place_of_birth').value = selectedItem.place_of_birth || '';
                        document.getElementById('birth_date').value = selectedItem.birth_date || '';

                        return `<div>${escape(selectedItem.name)}</div>`
                    }
                }
            });
        }
    </script>
@endPushOnce
