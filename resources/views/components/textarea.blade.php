@props(['disabled' => false, 'placeholder' => null])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm',
]) !!}
placeholder="{{ $placeholder ?? 'AAAAAAAAAAAAa' }}"
>{{ $slot }}</textarea>
