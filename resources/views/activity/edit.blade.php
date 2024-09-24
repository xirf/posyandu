<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Activity') }}
        </h2>
        <p>
            {{ __('Edit the activity, and share it with the world.') }}
        </p>
    </x-slot>

    <form action="{{ route('dashboard.activity.update', $activity->id) }}" id="activity-form" method="POST"
        x-data="{
            medias: {{ old('medias', $activity->medias) }},
            y_availableImages: [],
            y_selectedImage: {{ old('medias', $activity->medias) }},
            y_isImageLoading: true,
            y_endpoint: '{{ route('upload') }}',
            y_csrf: '{{ csrf_token() }}',
        
            y_selectLocalImage() {
                const input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/jpg,image/png,image/svg,image/jpeg,image/webp';
                input.click();
        
                input.onchange = () => {
                    const file = input.files[0];
                    if (file) this.y_saveToServer(file);
                };
            },
        
            y_saveToServer(file) {
                const fd = new FormData();
                fd.append('image', file);
                fetch(this.y_endpoint, {
                        method: 'POST',
                        headers: { 'X-CSRF-Token': this.y_csrf },
                        body: fd
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.y_img = data.url
                        console.log(data.url);
                        console.log(this.medias);
                        this.medias.push(data.url);
                        $dispatch('close-modal', 'add-medias-modal');
                        console.log(this.medias);
                    })
                    .catch(error => console.error(error));
            },
        
            y_insertSelectedImage() {
                if (this.y_selectedImage) {
                    this.y_img = this.y_selectedImage;
                    console.log(this.medias);
                    this.medias.push(this.y_selectedImage);
                    $dispatch('close-modal', 'add-medias-modal');
                    console.log(JSON.stringify(this.medias));
                    $dispatch('close-modal', 'add-medias-modal');
                }
            },
        
            fetchImages() {
                this.y_isImageLoading = true;
                fetch('{{ route('get.images') }}')
                    .then(response => response.json())
                    .then(images => this.y_availableImages = images)
                    .catch(error => console.error(error))
                    .finally(() => this.y_isImageLoading = false);
            }
        }">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col xl:flex-row p-4 gap-8  items-start">
            <div class="grow space-y-4">
                <div class="p-4 bg-white shadow sm:rounded-lg space-y-4" x-data="{ permalink: '{{ old('slug', $activity->slug) }}', overflow: false, sitePath: '{{ url('activity') }}' }">
                    <x-text-input class="w-full" placeholder="{{ __('Title') }}" name="title" id="title"
                        value="{{ old('title', $activity->title) }}" required autofocus
                        @input=" permalink = sitePath + '/' + $event.target.value.trim().toLowerCase().replace(/ /g, '-').replace(/[^\w-]/g, '').substring(0, 100);
                                 overflow = $event.target.value.length > 60">
                    </x-text-input>
                    <p x-show="overflow" class="text-orange-500 text-xs">
                        {{ __('It\'s not recommended to use more than 60 characters for the title') }}
                    </p>
                    <div class="text-sm text-gray-500">
                        <p>
                            {{ __('Permalink: ') }} <span x-text="permalink">{{ $activity->medias }}</span>
                        </p>
                        <input type="text" name="permalink" id="permalink" :value="permalink"
                            class="border border-gray-300 rounded-md w-full hidden" readonly>
                    </div>

                    <div class="hidden" id="quill-initial-data">
                        {!! old('about', $activity->content) !!}
                    </div>
                    <x-quill name="about" placeholder="Content here..." :endpoint="`{{ route('upload') }}`" :formId="'activity-form'" />
                </div>
                <div class="p-4 bg-white shadow sm:rounded-lg space-y-4"">
                    <div>
                        <h2 class="block mb-1 text-lg font-semibold text-gray-700">{{ __('Documentation') }}</h2>
                        <p class="text-xs text-gray">{{ __('Add a photo of the activity here ') }}</p>
                        <input type="text" class="hidden" name="medias" :value="JSON.stringify(medias)">
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <template x-for="(media, index) in medias" :key="index">
                            <div class="relative border">
                                <img :src="media" class="w-32 h-32 object-cover rounded-lg" alt="media">
                                <button type="button" @click="medias.splice(index, 1)"
                                    class="absolute top-2 right-2 p-1 bg-white rounded-full">
                                    <x-heroicon-o-trash class="w-5 h-5 text-red-500" />
                                </button>
                            </div>
                        </template>
                        @include('activity.edit.uploadfile')
                    </div>
                </div>
            </div>

            <div class="w-full max-w-md space-y-4">
                @include('activity.edit.sidebar', ['tags' => $allTags])
            </div>
        </div>
    </form>


    @pushIf($errors, 'scripts')
    <script>
        @foreach ($errors->all() as $error)
            notyf.error('{{ $error }}');
        @endforeach
    </script>
    @endPushIf
    @pushIf(session('success'), 'scripts')
    <script>
        notyf.success('{{ session('success') }}');
    </script>
    @endPushIf

</x-app-layout>
