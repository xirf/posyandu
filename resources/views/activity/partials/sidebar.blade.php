<div class="shadow bg-white sm:rounded-lg space-y-4 p-4 ">
    <div class="w-full flex justify-between">
        <div>
            <h2 class="block mb-1 text-lg font-semibold text-gray-700">{{ __('Post') }}</h2>
            <p class="text-xs text-gray">{{ __('Create a new post ') }}</p>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div class="flex gap-2 items-center">
            <x-heroicon-o-key class="w-5 h-5" />
            <p>{{ __('Status') }}</p>
        </div>
        <div class="col-span-2 w-full">
            <x-select :name="'status'" :id="'status'" :options="[
                [
                    'value' => 'draft',
                    'label' => 'Draft',
                ],
                [
                    'value' => 'published',
                    'label' => 'Published',
                ],
            ]" :placeholder="__('Choose')" :selected="old('status', 'published')" />
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div class="flex gap-2 items-center">
            <x-heroicon-o-calendar-days class="w-5 h-5" />
            <p>{{ __('Publish') }}</p>
        </div>
        <div class="col-span-2 w-full">
            <input type="datetime-local" name="published_at" value="{{ old('published_at', date('Y-m-d\TH:i')) }}"
                class="w-full text-sm py-3 px-4 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent" />
        </div>
    </div>
    <div class="w-full flex justify-end">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</div>
<div class="shadow bg-white sm:rounded-lg space-y-4 p-4 ">
    <div>
        <h2 class="block mb-1 text-lg font-semibold text-gray-700">{{ __('Tags') }}</h2>
        <p class="text-xs text-gray">{{ __('Press enter or use comma to add') }}</p>
    </div>

    <x-multi-select name="tags" :searchPlaceholderValue="'Search tags'" :multiple="true" :choices="$tags" :selected="old('tags', [])">
    </x-multi-select>
</div>

<x-select-image />