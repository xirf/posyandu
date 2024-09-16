{{-- 
* Please don't mess with this file unless you know what you're doing.
--}}
@php
    $menus = [__('All'), __('Infant'), __('Child'), __('Teenager'), __('Adult'), __('Elderly')];
@endphp

<x-app-layout>
    <div class="max-w-full sm:p-6 lg:p-8 bg-white shadow h-screen">
        <div class="w-full grow flex flex-col h-full space-y-4" x-data="{
            activeData: [],
            isOpen: false,
            openedWithKeyboard: false,
            selected: '{{ $menus[0] }}',
            isLoading: true,
            sortBy: null,
            async getTable(ageGroup = 'all', link = null) {
                this.isLoading = true;
                try {
                    let endpoint = link ? link : '{{ route('posyandu.table') }}';
                    let params = link ? {} : { ageGroup };
                    let response = await axios.get(endpoint, {
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        params
                    });
                    if (response.data.links.length > 6) {
                        let first3 = response.data.links.slice(0, 3);
                        let last3 = response.data.links.slice(-3);
                        response.data.links = [...first3, { label: '...', active: false, url: null }, ...last3];
                    }
                    this.activeData = response.data;
                    console.log('resdata: ', this.activeData.data);
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
            <div>
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-neutral-200">{{ __('Posyandu') }}</h2>
                <p>{{__("Click at the name for detailed view")}}</p>
            </div>
            <div class="w-full flex z-50 justify-between">
                <div class="flex gap-4">
                    @include('posyandu.partials.age-filter')
                    @include('posyandu.partials.search')
                </div>
                <div class="flex gap-4">
                    <x-secondary-button>Export</x-primary-button>
                        <x-primary-button>Add</x-primary-button>
                </div>
            </div>
            <div class="w-full overflow-auto grow border rounded-md h-full">
                @include('posyandu.partials.table')
            </div>
            @include('posyandu.partials.pagination')
        </div>

    </div>
</x-app-layout>
