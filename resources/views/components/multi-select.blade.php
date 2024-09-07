@pushOnce('style')
    <link rel="stylesheet" href="/css/choice.css" />
@endPushOnce

@pushOnce('script')
    <script src="/js/choice.js" defer></script>
@endPushOnce

<div class="mb-5">
    @if ($label ?? null)
        <label for="{{ $name }}" class="form-label block mb-1  text-lg font-semibold text-gray-700">
            {{ $label }}
            @if ($optional ?? null)
                <span class="text-sm text-gray-500 font-normal">(optional)</span>
            @endif
        </label>
    @endif

    <div class="relative" x-ref="select-parent" :class="{ 'select-has-error': error.length }" x-data="{
        error: '',
        isRemote: Boolean('{{ $remote ?? false }}') || false,
        endpoint: '{{ $endpoint ?? '' }}',
        maxItemCount: '{{ $maxItemCount ?? -1 }}' || -1
    }"
        x-init="document.addEventListener('DOMContentLoaded', () => {
            choice = new Choices($refs.input, {
                searchPlaceholderValue: '{{ $searchPlaceholderValue ?? '' }}' || null,
                removeItemButton: true,
                maxItemCount: Number(maxItemCount),
                duplicateItemsAllowed: false,
                // Since choices is an array no quotes is required
                choices: {{ json_encode($choices ?? []) }}
            });
        
            if (isRemote) {
                choice.setChoices(function() {
                    return fetch(endpoint)
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(data) {
                            return data.releases.map(function(release) {
                                return { value: release.title, label: release.title };
                            });
                        });
                });
            }
        });">
        <select id="{{ $name . Str::random(8) }}" x-on:change="error.length ? error = '' : ''" x-ref="input"
            x-on:choice="$refs['select-parent'].classList.remove('is-error')" name="{{ $name }}[]"
            class="w-full text-sm py-2 px-4 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
            placeholder="{{ $placeholder ?? '' }}" {{ $multiple ? 'multiple' : '' }}>
            {{ $slot }}
        </select>

        <div x-show="error.length > 0" class="-mt-4">
            <svg class="absolute text-red-600 fill-current w-5 h-5" style="top: 12px; right: 12px"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
            </svg>
            <div class="text-red-600 text-sm block leading-tight error-text" x-html="error"></div>
        </div>

        @error($name)
            <svg class="absolute text-red-600 fill-current w-5 h-5" style="top: 12px; right: 12px"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
            </svg>
            <div class="text-red-600 -mt-4 text-sm block leading-tight error-text">{{ $message }}</div>
        @enderror
    </div>
</div>
