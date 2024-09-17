@php
    $fields = [
        'cholesterol' => 'Cholesterol',
        'hemoglobin' => 'Hemoglobin',
        'gda' => 'Abdominal GDA',
    ];
@endphp

@foreach ($fields as $field => $label)
    <div class="w-full">
        <x-input-label for="{{ $field }}" :value="__($label)" />
        <x-text-input id="{{ $field }}" name="{{ $field }}" type="number" class="mt-1 block w-full"
            placeholder="{{ __($label) }}" />
        <x-input-error :messages="$errors->createReport->get($field)" class="mt-2" />
    </div>
@endforeach

<div class="w-full">
    <x-input-label for="ua" :value="__('Urine Test')" />
    <x-textarea id="ua" name="ua" class="mt-1 block w-full h-20" :placeholder="__('Urine Test')" />
    <x-input-error :messages="$errors->createReport->get('ua')" class="mt-2" />
</div>
