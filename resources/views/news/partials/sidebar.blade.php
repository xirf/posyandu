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
        <x-select name="status" :options="[
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

<div class="shadow bg-white sm:rounded-lg space-y-4 p-4 " x-data="{
    img: null,
    availableImages: [],
    selectedImage: null,
    isImageLoading: true,
    selectLocalImage() {
        document.querySelector('#thumbnail').click()
        $dispatch('close-modal', 'add-thumbnail-modal')
    },
}">
    <div>
        <h2 class="block mb-1  text-lg font-semibold text-gray-700">{{ __('Thumbnail') }}</h2>
        <p class="text-xs text-gray">{{ __('Click to add or change image') }}</p>
    </div>
    <div class="block cursor-pointer relative w-full aspect-video rounded-lg border border-gray overflow-hidden"
        @click="$dispatch('open-modal', 'add-thumbnail-modal')">
        <input type="file" name="thumbnail" id="thumbnail"
            class="opacity-0 w-full h-full absolute top-0 left-0 cursor-pointer">
        <img x-bind:src="img" class="w-full h-full object-cover rounded-lg" x-show="img != null" x-cloak>
        <div class="absolute top-0 left-0 w-full h-full flex flex-col  items-center justify-center">
            <x-heroicon-o-photo class="w-16 h-16 opacity-50" x-show="!img" />
            <p class="text-gray-600">{{ __('Click to add or change image') }}</p>
        </div>
    </div>

    <x-modal name="add-thumbnail-modal">
        <div class="p-6 space-y-6" x-on:close-modal.window="isImageLoading=false"
            x-on:open-modal.window="
            isImageLoading=true; fetch('{{ route('get.images') }}', { method: 'GET', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', } }).then(response => response.json()).then(x=> availableImages=x).catch(e => alert(e.message)).finally(() => isImageLoading=false);">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Add Image') }}
            </h2>

            <div class="mt-6 grid grid-cols-5 gap-2 max-h-96 overflow-y-auto">
                <template x-for="(image, index) in availableImages" :key="index">
                    <div class="w-full h-full">
                        <label x-bind:for="image"
                            class="w-full h-full rounded-md border aspect-square object-contain block overflow-hidden relative"
                            :class="selectedImage === image ? 'border-2 border-cyan-500' : 'border-none'">
                            <input type="radio" name="selected_image" x-bind:id="image"
                                x-on:change="selectedImage = image" class="hidden">
                            <img x-bind:src="image.replace('public/', '/storage/')" class="w-full h-full object-cover"
                                x-bind:alt="image">
                            <div class="absolute bottom-2 left-2 rounded-full p-1 bg-cyan-500"
                                x-show="selectedImage === image" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-white" />
                            </div>
                        </label>
                    </div>
                </template>
            </div>
            <div class="flex justify-end space-x-2">
                <x-secondary-button x-on:click="selectLocalImage()" type="button">
                    {{ __('Upload Image') }}
                </x-secondary-button>
                <x-primary-button x-on:click="insertSelectedImage" type="button">
                    {{ __('Insert Selected Image') }}
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
