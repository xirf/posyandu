@pushOnce('styles')
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

<div class="w-full">
    <x-input-label for="name" :value="__('Name')" required />
    <select id="select-patient" name="name" class="mt-1 block w-full text-sm" required></select>
    <x-input-error :messages="$errors->createReport->get('nama')" class="mt-2" />
</div>
<div class="w-full">
    <x-input-label for="gender" :value="__('Gender')" required />
    <select id="gender" name="gender"
        class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm text-sm"
        placeholder="{{ __('Choose Gender') }}" required>
        <option value="male">{{ __('Male') }}</option>
        <option value="female">{{ __('Female') }}</option>
    </select>
    <x-input-error :messages="$errors->createReport->get('gender')" class="mt-2" />
</div>
@php
    $fields = [
        'nik' => 'NIK',
        'place_of_birth' => 'Place Of Birth',
        'birth_date' => 'Birth Date',
        'dukuh' => 'Dukuh',
        'rt' => 'RT',
        'rw' => 'RW'
    ];
@endphp

@foreach ($fields as $field => $label)
    <div class="w-full">
        <x-input-label for="{{ $field }}" :value="__($label)" />
        <x-text-input id="{{ $field }}" name="{{ $field }}" type="{{ in_array($field, ['rt', 'rw']) ? 'number' : 'text' }}" class="mt-1 block w-full"
            placeholder="{{ __($label) }}" />
        <x-input-error :messages="$errors->createReport->get($field)" class="mt-2" />
    </div>
@endforeach

@pushOnce('scripts')
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
                        const date = item.birthdate || unknownText;

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
                                        <div class="col-span-4">: ${escape(item.place_of_birth) || unknownText} - ${escape(item.birthdate) || unknownText}</div>
                                    </div>
                                </div>`;
                    },
                    item: function(selectedItem, escape) {
                        document.getElementById('nik').value = selectedItem.nik || '';
                        document.getElementById('gender').value = selectedItem.gender || '';
                        document.getElementById('place_of_birth').value = selectedItem.place_of_birth || '';
                        document.getElementById('birth_date').value = selectedItem.birthdate || '';
                        document.getElementById('dukuh').value = selectedItem.dukuh || '';
                        document.getElementById('rt').value = selectedItem.rt || '';
                        document.getElementById('rw').value = selectedItem.rw || '';

                        return `<div>${escape(selectedItem.name)}</div>`
                    }
                }
            });
        }
    </script>
@endPushOnce
