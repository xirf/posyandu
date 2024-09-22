@props(['header', 'message', 'button'])

<div class="w-full flex items-center flex-wrap justify-center gap-10">
    <div class="grid gap-4 w-full max-w-lg">
        <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full shadow-sm justify-center items-center inline-flex">
            <x-heroicon-o-newspaper class="w-12 h-12 text-gray-500" />
        </div>
        <div>
            <h2 class="text-center text-black text-base font-semibold leading-relaxed pb-1">{{ $header }}</h2>
            <p class="text-center text-black text-sm font-normal leading-snug pb-4">{{ $message }} </p>
            @isset($button)
                <div class="flex gap-3"> {{ $button }} </div>
            @endisset
        </div>
    </div>
</div>
