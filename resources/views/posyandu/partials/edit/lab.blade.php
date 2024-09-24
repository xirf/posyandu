@php
    $fields = [
        'cholesterol' => 'Cholesterol',
        'hemoglobin' => 'Hemoglobin',
        'gda' => 'GDA',
    ];
@endphp

@foreach ($fields as $field => $label)
    <div class="w-full">
        <x-input-label for="{{ $field }}" :value="__($label)" />
        <x-text-input id="{{ $field }}" name="{{ $field }}" type="number" class="mt-1 block w-full"
            placeholder="{{ __($label) }}" 
            value="{{ old($field, $medicalRecord->labResults->$field) }}"
            min="0"
            max="900000000000"
            step="0.01"
            />
        <x-input-error :messages="$errors->createReport->get($field)" class="mt-2" />
    </div>
@endforeach

<div class="w-full">
    <x-input-label for="ua" :value="__('Urine Test')" />
    <x-textarea id="ua" name="ua" class="mt-1 block w-full h-20" :placeholder="__('Urine Test')"
        value="{{ old('ua', $medicalRecord->labResults->ua) }}"
    >{{ old('ua', $medicalRecord->labResults->ua) }}</x-textarea>
    <x-input-error :messages="$errors->createReport->get('ua')" class="mt-2" />
</div>
