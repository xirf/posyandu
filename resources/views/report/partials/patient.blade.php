<div class="w-full h-full p-4">
    <h3 class="block mb-1 text-lg font-semibold text-gray-700">{{ __('Patient Information') }}</h3>
    <div class="flex flex-col gap-4">
        <select id="select-patient" class="w-full"></select>
    </div>
</div>

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
    </style>
@endPushOnce

@pushOnce('script')
    <script src="/js/tom-select.js" defer></script>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            initTomSelect();
        });

        function initTomSelect() {
            new TomSelect('#select-patient', {
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                multiple: false,
                load: function(query, callback) {
                    console.log(callback)
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
                            console.log('Fetched data:', json);
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
                        console.log('Rendering item:', item);
                        return `<div class="py-2 d-flex">
                            <div class="mb-1">
                                <span class="h5">
                                    ${ escape(item.name) }
                                </span>
                            </div>
                            <div class="ms-auto">${ escape(item.address) }</div>
                        </div>`;
                    }
                },
            });
        }
    </script>
@endPushOnce
