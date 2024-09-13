@php
    $inputFields = [
        ['weight', __('Weight')],
        ['height', __('Height')],
        ['arm_circumference', __('Arm Circumference')],
        ['head_circumference', __('Head Circumference')],
        ['abdominal_circumference', __('Abdominal Circumference')],
    ];

    $medicalHistory = [
        ['family_planning', __('Family Planning')],
        ['hypertension', __('Hypertension')],
        ['diabetes', __('Diabetes')],
    ];
@endphp

<div class="w-full h-full p-4">
    <h3 class="block mb-1 text-lg font-semibold text-gray-700">{{ __('Measurement') }}</h3>
    <div class="grid gap-4">
        @foreach ($inputFields as $field)
            <div>
                <x-input-label for="{{ $field[0] }}" :value="$field[1]" />
                <x-text-input id="{{ $field[0] }}" name="{{ $field[0] }}" type="number" class="mt-1 block w-full"
                    placeholder="{{ $field[1] }}" />
                <x-input-error :messages="$errors->createReport->get($field[0])" class="mt-2" />
            </div>
        @endforeach

        <hr class="my-4 border-gray-200">
        <h3 class="block mb-1 text-lg font-semibold text-gray-700">{{ __('Medical History') }}</h3>
        <div class="flex flex-wrap gap-y-2 gap-x-4">
            @foreach ($medicalHistory as $item)
                <div class="flex gap-2 items-center">
                    <input type="checkbox" id="{{ $item[0] }}" class="checkbox checkbox-sm checkbox-primary peer" />
                    <label for="{{ $item[0] }}"
                        class="">
                        <span>{{ $item[1] }}</span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>
