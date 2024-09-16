@php
    $fields = [
        'cholesterol' => 'Cholesterol',
        'hemoglobin' => 'Hemoglobin',
        'gda' => 'Abdominal GDA',
        'ua' => 'Urine Test',
    ];
@endphp

@foreach ($fields as $field => $label)
    <div class="w-full">
        <x-input-label for="{{ $field }}" :value="__($label)" />
        <x-text-input id="{{ $field }}" name="{{ $field }}" type="{{ in_array($field, ['rt', 'rw']) ? 'number' : 'text' }}" class="mt-1 block w-full"
            placeholder="{{ __($label) }}" />
        <x-input-error :messages="$errors->createReport->get($field)" class="mt-2" />
    </div>
@endforeach
