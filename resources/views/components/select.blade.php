<select name="{{ $name }}" id="{{ $id }}"
    class="w-full text-sm py-3 px-4 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
    <option value="" selected disabled>{{ $placeholder }}</option>
    @foreach ($options as $option)
        <option value="{{ $option['value'] }}" {{ $selected == $option['value'] ? 'selected' : '' }}>
            {{ $option['label'] }}
        </option>
    @endforeach
</select>

