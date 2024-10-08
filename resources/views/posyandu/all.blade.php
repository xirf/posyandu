{{-- 
* Please don't mess with this file unless you know what you're doing.
--}}
@php
    $menus = [
        ['all', __('All')],
        ['infant', __('Infant')],
        ['child', __('Child')],
        ['teenager', __('Teenager')],
        ['adult', __('Adult')],
        ['elderly', __('Elderly')],
    ];
@endphp

<x-app-layout>
    <div class="max-w-full sm:p-6 lg:p-8 bg-white shadow h-screen" x-data="{
        activeData: [],
        isOpen: false,
        modelOpen: false,
        openedIndex: 0,
        openedWithKeyboard: false,
        selected: '{{ $menus[0][0] }}',
        selectedPatient: null,
        ages: {
            'all': '{{ __('All') }}',
            'infant': '{{ __('Infant') }}',
            'child': '{{ __('Child') }}',
            'teenager': '{{ __('Teenager') }}',
            'adult': '{{ __('Adult') }}',
            'elderly': '{{ __('Elderly') }}',
        },
        isLoading: true,
        sortBy: null,
        async getTable(ageGroup = 'all', link = null) {
            this.isLoading = true;
            try {
                let endpoint = link ? link : '{{ route('posyandu.table') }}';
                let params = { ageGroup };
                let response = await axios.get(endpoint, {
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    params
                });
                this.activeData = response.data;
            } catch (error) {
                console.error(error);
            } finally {
                this.isLoading = false;
            }
        },
        init() {
            this.getTable();
        },
        sortBy(column) {
            const getNestedValue = (obj, path) => path.split('.').reduce((acc, part) => acc && acc[part], obj);
            if (this.activeData.sortBy === column) {
                this.activeData.data.reverse();
                return;
            }
            if (typeof getNestedValue(this.activeData.data[0], column) === 'number') {
                this.activeData.data.sort((a, b) => getNestedValue(a, column) - getNestedValue(b, column));
            } else {
                this.activeData.data.sort((a, b) => getNestedValue(a, column).localeCompare(getNestedValue(b, column)));
            }
    
            this.activeData.sortBy = column;
        },
        async search(keyword) {
            this.isLoading = true;
            try {
                let response = await axios.get('{{ route('posyandu.table.search') }}', {
                    params: { search: keyword },
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });
                this.activeData = response.data;
            } catch (error) {
                console.error(error);
            } finally {
                this.isLoading = false;
            }
        }
    }">
        <div class="w-full grow flex flex-col h-full space-y-2 p-4">
            <div class="w-full grid md:flex grid-cols-3 md:flex-row z-50 flex-end gap-4">
                <div class="grow col-span-3">
                    <h2 class="text-lg font-semibold text-neutral-900 dark:text-neutral-200">{{ __('Posyandu') }}</h2>
                    <p class="text-xs font-normal text-neutral-500 dark:text-neutral-400">
                        {{ __('Click name to see more') }}</p>
                </div>
                <div class="col-span-3 md:max-w-36">
                    @include('posyandu.partials.search')
                </div>
                <div class="grid grid-cols-3 md:w-80 gap-4 col-span-3">
                    @include('posyandu.partials.age-filter')
                    @include('posyandu.partials.export')
                    <a href="{{ route('dashboard.posyandu.create') }}" class="w-full">
                        <x-primary-button class="w-full"> {{ __('Add') }} </x-primary-button>
                    </a>
                </div>
            </div>
            <div class="w-full overflow-auto grow border rounded-md h-full">
                @include('posyandu.partials.table')
            </div>
            @include('posyandu.partials.pagination')
        </div>
        @include('posyandu.partials.modal')
    </div>

    @if(session('success'))
        @push('scripts')
            <script>
                notyf.success('{{ session('success') }}');
            </script>
        @endpush
    @endif
</x-app-layout>
