<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit News') }}
        </h2>
        <p>
            {{ __('Edit your current news, and share it with the world.') }}
        </p>
    </x-slot>

    <form action="{{ route('dashboard.news.update', $post->id) }}" id="news-form" method="POST">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-8  items-start">
            <div class="grow space-y-4">
                <div class="p-4 bg-white shadow sm:rounded-lg space-y-4" x-data="{
                    permalink: '{{ old('permalink', $post->slug) }}',
                    overflow: false,
                    sitePath: '{{ url('news') }}'
                }">
                    <x-text-input class="w-full" placeholder="{{ __('Title') }}" name="title" id="title"
                        value="{{ old('title', $post->title) }}" required autofocus
                        @input=" permalink = sitePath + '/' + $event.target.value.trim().toLowerCase().replace(/ /g, '-').replace(/[^\w-]/g, '').substring(0, 100);
                                 overflow = $event.target.value.length > 60">
                    </x-text-input>
                    <div class="text-sm text-gray-500">
                        <p>
                            {{ __('Permalink: ') }} <span x-text="permalink"></span>
                        </p>
                        <input type="text" name="permalink" id="permalink" :value="permalink"
                            class="border border-gray-300 rounded-md w-full hidden" readonly>
                    </div>

                    <div class="hidden" id="quill-initial-data">
                        {!! old('about', $post->content) !!}
                    </div>
                    <x-quill name="about" placeholder="{{ __('Content here...') }}" :endpoint="`{{ route('upload') }}`"
                        :formId="'news-form'" />
                </div>
            </div>

            <div class="w-full max-w-md space-y-4">
                @include('news.partials.edit.sidebar', ['tags' => $allTags])
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
