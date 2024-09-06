<div class="p-4 bg-white shadow sm:rounded-lg space-y-4" x-data="{ permalink: '', overflow: false, siteNewsPath: '{{ route('dashboard') }}' }">
    <x-text-input class="w-full" placeholder="{{__('Title')}}"
        @input=" permalink = siteNewsPath + '/' + $event.target.value.trim().replace(/ /g, '-').replace(/[^\w-]/g, '').substring(0, 100);
                 overflow = $event.target.value.length > 100">
    </x-text-input>
    <div class="text-sm text-gray-500">
        <p>
            {{ __('Permalink: ') }} <span x-text="permalink"></span>
        </p>
        <p x-show="overflow" class="text-red-500">
            Judul terlalu panjang, url akan disingkat
        </p>
        <input type="text" name="permalink" id="permalink" :value="permalink"
            class="border border-gray-300 rounded-md w-full hidden" readonly>
    </div>
</div>
