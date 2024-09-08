<div class="shadow bg-white sm:rounded-lg space-y-4 p-4 ">
    <div class="w-full flex justify-end">
        <x-primary-button>{{ __('Publish') }}</x-primary-button>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex gap-2 items-center">
            <x-heroicon-o-key class="w-5 h-5" />
            <p>{{ __('Status') }}</p>
        </div>
        <x-select :name="'status'" :id="'status'" :options="[
            [
                'value' => 'draft',
                'label' => 'Draft',
            ],
            [
                'value' => 'published',
                'label' => 'Published',
            ],
        ]" :placeholder="__('Choose')" />
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex gap-2 items-center">
            <x-heroicon-o-calendar-days class="w-5 h-5" />
            <p>{{ __('Publish') }}</p>
        </div>
        <input type="datetime-local" name="published_at" value="{{ date('Y-m-d\TH:i') }}"
            class="w-full text-sm py-2 px-4 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent" />
    </div>
</div>
<div class="shadow bg-white sm:rounded-lg space-y-4 p-4 ">
    <div class="flex w-full items-center justify-between">
        <h2 class="block mb-1  text-lg font-semibold text-gray-700">{{ __('Tags') }}</h2>
        <x-secondary-button>{{ __('Add New Tag') }}</x-secondary-button>
    </div>

    <x-multi-select name="tags" :searchPlaceholderValue="'Search tags'" :multiple="true" :choices="[['value' => 'All The Time', 'label' => 'All The Time'], ['value' => 'Angles', 'label' => 'Angles']]">
    </x-multi-select>
</div>

@include('news.partials.select-image')
