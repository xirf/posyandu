<div class="relative flex w-full max-w-xs flex-col gap-1 text-neutral-600 dark:text-neutral-300">
    <x-heroicon-o-magnifying-glass class="absolute top-2 left-3 w-5 h-5" />
    <input type="search"
        x-on:input.debounce.300ms="search($event.target.value)"
        class="w-full rounded-md border border-neutral-300 bg-neutral-50 py-2 pl-10 pr-2 text-sm focus:border-cyan-500 focus:ring-cyan-500  
"
        name="search" placeholder="{{ __('Search...') }}" aria-label="{{ __('Search...') }}" />
</div>