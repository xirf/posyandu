<div class="shadow bg-white sm:rounded-lg space-y-4 p-4 ">
    <div class="w-full flex justify-between items-center">
        <x-secondary-button>{{ __('Save as Draft') }}</x-secondary-button>
        <x-primary-button>{{ __('Publish') }}</x-primary-button>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex gap-2 items-center">
            <x-heroicon-o-key class="w-5 h-5" />
            <p>{{ __('Status') }}</p>
        </div>
        <x-select :options="[
            [
                'value' => 'draft',
                'label' => 'Draft',
            ],
            [
                'value' => 'publish',
                'label' => 'Published',
            ],
        ]" :placeholder="__('Choose')" />
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex gap-2 items-center">
            <x-heroicon-o-calendar-days class="w-5 h-5" />
            <p>{{ __('Publish') }}</p>
        </div>
        <input type="datetime-local"
            class="w-full text-sm py-2 px-4 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent" />
    </div>
</div>
<div class="shadow bg-white sm:rounded-lg space-y-4 p-4 ">
    <div class="flex w-full items-center justify-between">
        <h2 class="block mb-1  text-lg font-semibold text-gray-700">{{ __('Tags') }}</h2>
        <x-secondary-button>{{ __('Add New Tag') }}</x-secondary-button>
    </div>

    <x-multi-select name="status" :searchPlaceholderValue="'Search tags'" :multiple="true"
        :choices="[
            ['value' => 'All The Time', 'label' => 'All The Time'],
            ['value' => 'Angles', 'label' => 'Angles'],
        ]">
    </x-multi-select>
</div>

<div class="shadow bg-white sm:rounded-lg space-y-4 p-4 " x-data="{ img: null }">
    <div>
        <h2 class="block mb-1  text-lg font-semibold text-gray-700">{{ __('Thumbnail') }}</h2>
        <p class="text-xs text-gray">{{__("Click to add or change image")}}</p>
    </div>
    <div class="relative w-full aspect-video rounded-lg border border-gray overflow-hidden">
        <input type="file" name="thumbnail" id="thumbnail"
            class="opacity-0 w-full h-full absolute top-0 left-0 cursor-pointer"
            x-on:change="img = URL.createObjectURL($event.target.files[0])">
        <img x-bind:src="img" class="w-full h-full object-cover rounded-lg" x-show="img != null" x-cloak>
        <div class="absolute top-0 left-0 w-full h-full flex flex-col  items-center justify-center">
            <x-heroicon-o-photo class="w-16 h-16 opacity-50" x-show="!img" />
            <p class="text-gray-600">{{__("Click to add or change image")}}</p>
        </div>
    </div>
</div>
