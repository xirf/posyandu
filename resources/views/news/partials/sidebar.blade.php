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
            <input type="datetime-local" class="w-full text-sm py-2 px-4 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent" />
        </div>
    </div>
    <div class="shadow bg-white sm:rounded-lg space-y-4 p-4 ">
        <h2>{{ __('Tags') }}</h2>
    </div>
