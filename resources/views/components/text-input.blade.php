@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 text-sm focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm']) !!}>
