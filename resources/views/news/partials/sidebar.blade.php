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
            <x-select-input label="ABC">
                <option value="draft">Draft</option>
                <option value="publish">Published</option>
            </x-select-input>
        </div>
        <div class="flex gap-2 items-center">
            <div class="flex gap-2 items-center">
                <x-heroicon-o-eye class="w-5 h-5" />
                <p>{{ __('Visibility') }}</p>
            </div>
        </div>
        <div class="flex gap-2 items-center">
            <div class="flex gap-2 items-center">
                <x-heroicon-o-calendar-days class="w-5 h-5" />
                <p>{{ __('Publish') }}</p>
            </div>
        </div>
    </div>
    <div class="shadow bg-white sm:rounded-lg space-y-4 p-4 ">
        <h2>{{ __('Tags') }}</h2>
    </div>

