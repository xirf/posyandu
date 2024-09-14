@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm',
]) !!}>
{{ $slot }}
</textarea>
