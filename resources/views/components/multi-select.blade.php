@php
    $elementId = $elementId ?? 's_' . Str::random(8);
@endphp

@pushOnce('style')
    <link href="/css/tom-select.css" rel="stylesheet">
    <script src="/js/tom-select.js"></script>
@endPushOnce

@pushOnce('script')
    <script>
        new TomSelect("#{{ $elementId }}", {
            persist: false,
            createOnBlur: true,
            create: true,
            maxItems: null,
            maxOptions: 100,
            valueField: 'id',
            labelField: 'title',
            searchField: 'title',
            sortField: 'title',
        });
    </script>
@endPushOnce

<div class="mb-5 w-full">
    @if ($label ?? null)
        <label for="{{ $name }}" class="form-label block mb-1  text-lg font-semibold text-gray-700">
            {{ $label }}
            @if ($optional ?? null)
                <span class="text-sm text-gray-500 font-normal">(optional)</span>
            @endif
        </label>
    @endif


    <select class="form-control w-full text-base" placeholder="{{ $placeholder ?? 'Pilih tags' }}" multiple="multiple"
        name="{{ $name }}[]" id="{{ $elementId }}">
        @foreach ($choices as $choice)
            <option value="{{ $choice['value'] }}">{{ $choice['label'] }}</option>
        @endforeach
    </select>

</div>
