@pushOnce('styles')
    <link href="/css/quill.snow.css" rel="stylesheet">
@endPushOnce

@pushOnce('scripts')
    <script src="/js/quill.js" defer></script>
    <script src="/js/quill-image-resize.js" defer></script>
@endPushOnce

<div class="mb-5" x-data="{
    content: '',
    availableImages: [],
    selectedImage: null,
    isImageLoading: true,
    endpoint: '{{ $endpoint ?? '' }}',
    csrf: '{{ csrf_token() }}',
    selectLocalImage() {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.click();

        input.onchange = () => {
            const file = input.files[0];
            if (/^image\//.test(file.type)) {
                this.saveToServer(file);
            } else {
                console.warn('You could only upload images.');
            }
        };
    },
    saveToServer(file) {
        const fd = new FormData();
        fd.append('image', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', this.endpoint, true);
        xhr.setRequestHeader('X-CSRF-Token', this.csrf);

        xhr.upload.onprogress = function(event) {
            var progress = Math.round(event.loaded / event.total * 100) + '%';
            var progressBar = document.getElementById('quillProgressBar');
            if (event.lengthComputable) {
                progressBar.style = `width: ${parseFloat(progress)}`;
                if (event.loaded == event.total) {
                    progressBar.style = 'width: 0%';
                }
            }
        };

        xhr.onload = function() {
            if (this.status >= 200 && this.status < 300) {
                const data = JSON.parse(this.responseText);
                const range = quill.getSelection();
                quill.insertEmbed(range.index, 'image', `/${data.url}`);
                quill.setSelection(range.index + 1, Quill.sources.SILENT);
                $dispatch('close-modal', 'add-image');
            }
        };
        xhr.send(fd);
    },
    insertSelectedImage() {
        if (this.selectedImage) {
            const range = quill.getSelection();
            quill.insertEmbed(range.index, 'image', this.selectedImage.replace('public/', '/storage/'));
            quill.setSelection(range.index + 1, Quill.sources.SILENT);
            $dispatch('close-modal', 'add-image');
        }
    }
}" x-init="document.addEventListener('DOMContentLoaded', () => {
    quill = new Quill($refs.quillEditor, {
        scrollingContainer: '.ql-scrolling-container',
        modules: {
            history: {
                delay: 2000,
                maxStack: 500,
                userOnly: true
            },
            toolbar: {
                container: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }, 'bold', 'italic', 'underline', 'strike', { 'color': [] }, { 'background': [] }],
                    ['link', 'blockquote', 'image'],
                    [{ list: 'ordered' }, { list: 'bullet' }, { 'align': [] }],
                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                    ['clean', { 'undo': 'undo' }, { 'redo': 'redo' }]
                ],
                handlers: {
                    image: () => {
                        $dispatch('open-modal', 'add-image');
                    },
                    undo: () => {
                        this.quill.history.undo();
                    },
                    redo: () => {
                        this.quill.history.redo();
                    }
                }
            },
            imageResize: {
                displaySize: true
            },
        },
        theme: 'snow',
        placeholder: '{{ $placeholder ?? 'Write something great!' }}'
    });
    quill.on('text-change', function() {
        let html = quill.root.innerHTML;
        if (html === '<p><br></p>') html = ''
        content = html;
    });
    content = (quill.root.innerHTML === '<p><br></p>') ?
        '' :
        quill.root.innerHTML;
});

document.querySelector('#{{ $formId }}').addEventListener('formdata', (event) => {
    event.formData.append('about', JSON.stringify(quill.getContents().ops));
});" x-cloak>

    @if ($label ?? null)
        <label for="{{ $name }}" class="form-label block mb-1 font-semibold text-gray-700">
            {{ $label }}
            @if ($optional ?? null)
                <span class="text-sm text-gray-500 font-normal">(optional)</span>
            @endif
        </label>
    @endif

    <div class="relative {{ $errors->has($name) ? 'ql-editor-haserror' : '' }}">
        <div class="w-full pl-px pr-px bg-transparent z-20 absolute left-0 right-0" style="top: 38px;">
            <div id="quillProgressBar" class="bg-green-600 text-xs leading-none h-1" style="width: 0%"></div>
        </div>

        <textarea class="hidden" name="{{ $name }}" :value="content"></textarea>
        <div x-ref="quillEditor" x-model="content"
            class="bg-white min-h-full h-auto focus-visible:outline-none focus:outline-cyan-600">
            {!! old($name, $value ?? '') !!}
        </div>

        @error($name)
            <svg class="absolute z-10 text-red-600 fill-current w-5 h-5" style="top: 12px; right: 12px"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
            </svg>
            <div class="text-red-600 mt-2 text-sm block leading-tight">{{ $message }}</div>
        @enderror
    </div>

    <x-modal name="add-image">
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
