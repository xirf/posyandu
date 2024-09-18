@props(['endpoint' => route('upload')])


<div class="block cursor-pointer relative aspect-video border-dashed rounded-lg border border-black overflow-hidden w-32 h-32"
    @click="$dispatch('open-modal', 'add-medias-modal')">
    <div class="absolute top-0 left-0 w-full h-full flex flex-col items-center justify-center p-2">
        <x-heroicon-o-photo class="w-12 h-12 opacity-50" />
        <p class="text-gray-600 text-xs text-center">{{ __('Click to add or change image') }}</p>
    </div>
</div>

<x-modal name="add-medias-modal">
    <div class="p-6 space-y-6" x-on:close-modal.window="y_isImageLoading=false" x-on:open-modal.window="fetchImages">

        <h2 class="text-lg font-medium text-gray-900">{{ __('Add Image') }}</h2>

        <div class="mt-6 grid grid-cols-5 gap-2 max-h-96 overflow-y-auto">
            <template x-for="(image, index) in y_availableImages" :key="index">
                <div class="w-full h-full">
                    <label :for="'y_' + image"
                        class="w-full h-full rounded-md border aspect-square object-contain block overflow-hidden relative"
                        :class="y_selectedImage === image ? 'border-2 border-cyan-500' : 'border-none'">
                        <input type="radio" name="selected_image" :id="'y_' + image"
                            @change="y_selectedImage = image" class="hidden">
                        <img :src="image" class="w-full h-full object-cover" :alt="image">
                        <div class="absolute bottom-2 left-2 rounded-full p-1 bg-cyan-500"
                            x-show="y_selectedImage === image" x-transition:enter="transition ease-out duration-300"
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
            <x-secondary-button @click="y_selectLocalImage" type="button">{{ __('Upload Image') }}</x-secondary-button>
            <x-primary-button @click="y_insertSelectedImage"
                type="button">{{ __('Insert Selected Image') }}</x-primary-button>
        </div>
    </div>
</x-modal>
