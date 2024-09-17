@php
    $fields = [
        'weight' => 'Weight',
        'height' => 'Height',
        'abdominal_circumference' => 'Abdominal Circumference',
        'arm_circumference' => 'Arm Circumference',
        'head_circumference' => 'Head Circumference'
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
