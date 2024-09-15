<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between flex-wrap">
            {{ __('Add News') }}
        </h2>
    </x-slot>

    <form class="py-12" action="{{ $submit_to }}" id="news-form" method="POST">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-8  items-start">
            <div class="grow space-y-4">
                <div class="p-4 bg-white shadow sm:rounded-lg space-y-4" x-data="{ permalink: '{{ old('permalink', url('news')) }}', overflow: false, sitePath: '{{ url('news') }}' }">
                    <x-text-input class="w-full" placeholder="{{ __('Title') }}" name="title" id="title"
                        value="{{ old('title') }}" required autofocus
                        @input=" permalink = sitePath + '/' + $event.target.value.trim().toLowerCase().replace(/ /g, '-').replace(/[^\w-]/g, '').substring(0, 100);
                                 overflow = $event.target.value.length > 60">
                    </x-text-input>
                    <p x-show="overflow" class="text-orange-500 text-xs">
                        {{ __('It\'s not recommended to use more than 60 characters for the title') }}
                    </p>
                    <div class="text-sm text-gray-500">
                        <p>
                            {{ __('Permalink: ') }} <span x-text="permalink"></span>
                        </p>
                        <input type="text" name="permalink" id="permalink" :value="permalink"
                            class="border border-gray-300 rounded-md w-full hidden" readonly>
                    </div>

                    <x-quill name="body" value="{{ old('body') }}" placeholder="Content here..." :endpoint="`{{ route('upload') }}`"
                        :formId="'news-form'" />
                </div>
            </div>

            <div class="w-full max-w-md space-y-4">
                @include('news.partials.sidebar', ['tags' => $tags])
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
