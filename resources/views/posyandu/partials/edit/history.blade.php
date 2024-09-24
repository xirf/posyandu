@php
    $fields = [
        'complaints' => 'Complaints',
        'diagnosis' => 'Diagnosis',
        'medication' => 'Medication',
        'diseases' => 'Disease',
    ];
@endphp

@foreach ($fields as $field => $label)
    <div class="w-full">
        <x-input-label for="{{ $field }}" :value="__($label)" />
        <x-textarea id="{{ $field }}" name="{{ $field }}" class="mt-1 block w-full h-32"
            :placeholder="__($label)">{{ old($field, $medicalRecord->$field) }}</x-textarea>
        <x-input-error :messages="$errors->createReport->get($field)" class="mt-2" />
    </div>
@endforeach
