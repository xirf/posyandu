@php
    $medicalNotesSections = [
        ['complaints', __('Complaints')],
        ['diagnosis', __('Diagnosis')],
        ['treatment', __('Treatment')],
    ];
@endphp

<div class="p-4 flex flex-col h-full">
    <h3 class="block mb-1 text-lg font-semibold text-gray-700">{{ __('Medical Notes') }}</h3>
    <div class="grid gap-4 grow ">
        @foreach ($medicalNotesSections as $section)
            <div class="h-full flex flex-col">
                <x-input-label for="{{ $section[0] }}" :value="$section[1]" />
                <textarea id="{{ $section[0] }}" name="{{ $section[0] }}" class="mt-1 block grow w-full rounded-md shadow-sm border-gray-300 focus:border-cyan-500 focus:ring-cyan-500" placeholder="{{ $section[1] }}" required></textarea>
                <x-input-error :messages="$errors->createReport->get($section[0])" class="mt-2" />
            </div>
        @endforeach
    </div>
</div>
