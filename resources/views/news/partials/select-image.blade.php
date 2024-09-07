@props(['endpoint' => route('upload')])

<div class="shadow bg-white sm:rounded-lg space-y-4 p-4" x-data="{
    x_img: null,
    x_availableImages: [],
    x_selectedImage: null,
    x_isImageLoading: true,
    x_endpoint: '{{ $endpoint ?? '' }}',
    x_csrf: '{{ csrf_token() }}',

    x_selectLocalImage() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/jpg,image/png,image/svg,image/jpeg,image/webp';
        input.click();

        input.onchange = () => {
            const file = input.files[0];
            if (file) this.x_saveToServer(file);
        };
    },

    x_saveToServer(file) {
        const fd = new FormData();
        fd.append('image', file);
        console.log(this.x_endpoint)
        fetch(this.x_endpoint, {
                method: 'POST',
                headers: { 'X-CSRF-Token': this.x_csrf },
                body: fd
            })
            .then(response => response.json())
            .then(data => {
                this.x_img = '/' + data.url
                $dispatch('close-modal', 'add-thumbnail-modal');
            })
            .catch(error => console.error(error));
    },

    x_insertSelectedImage() {
        if (this.x_selectedImage) {
            this.x_img = this.x_selectedImage.replace('public/', '/storage/');
            $dispatch('close-modal', 'add-thumbnail-modal');
        }
    },

    fetchImages() {
        this.x_isImageLoading = true;
        fetch('{{ route('get.images') }}')
            .then(response => response.json())
            .then(images => this.x_availableImages = images)
            .catch(error => console.error(error))
            .finally(() => this.x_isImageLoading = false);
    }
}">

    <div>
        <h2 class="block mb-1 text-lg font-semibold text-gray-700">{{ __('Thumbnail') }}</h2>
        <p class="text-xs text-gray">{{ __('Click to add or change image') }}</p>
    </div>

    <div class="block cursor-pointer relative w-full aspect-video rounded-lg border border-gray overflow-hidden"
        @click="$dispatch('open-modal', 'add-thumbnail-modal')">
        <input type="text" name="thumbnail" id="thumbnail" x-bind:value="x_img"
            class="opacity-0 w-full h-full absolute top-0 left-0 cursor-pointer">
        <img x-bind:src="x_img" class="w-full h-full object-contain object-center rounded-lg" x-show="x_img"
            x-cloak>
        <div class="absolute top-0 left-0 w-full h-full flex flex-col items-center justify-center" x-show="!x_img">
            <x-heroicon-o-photo class="w-16 h-16 opacity-50" />
            <p class="text-gray-600">{{ __('Click to add or change image') }}</p>
        </div>
    </div>

    <x-modal name="add-thumbnail-modal">
        <div class="p-6 space-y-6" x-on:close-modal.window="x_isImageLoading=false"
            x-on:open-modal.window="fetchImages">

            <h2 class="text-lg font-medium text-gray-900">{{ __('Add Image') }}</h2>

            <div class="mt-6 grid grid-cols-5 gap-2 max-h-96 overflow-y-auto">
                <template x-for="(image, index) in x_availableImages" :key="index">
                    <div class="w-full h-full">
                        <label :for="'x_' + image"
                            class="w-full h-full rounded-md border aspect-square object-contain block overflow-hidden relative"
                            :class="x_selectedImage === image ? 'border-2 border-cyan-500' : 'border-none'">
                            <input type="radio" name="selected_image" :id="'x_' + image"
                                @change="x_selectedImage = image" class="hidden">
                            <img :src="image.replace('public/', '/storage/')" class="w-full h-full object-cover"
                                :alt="image">
                            <div class="absolute bottom-2 left-2 rounded-full p-1 bg-cyan-500"
                                x-show="x_selectedImage === image" x-transition:enter="transition ease-out duration-300"
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
                <x-secondary-button @click="x_selectLocalImage"
                    type="button">{{ __('Upload Image') }}</x-secondary-button>
                <x-primary-button @click="x_insertSelectedImage"
                    type="button">{{ __('Insert Selected Image') }}</x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
