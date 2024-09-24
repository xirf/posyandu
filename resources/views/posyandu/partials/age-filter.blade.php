<div class="relative" @keydown.esc.window="isOpen = false, openedWithKeyboard = false" class="w-full">
    <!-- Toggle Button -->
    <button type="button" @click="isOpen = ! isOpen"
        class="inline-flex w-full cursor-pointer items-center gap-2 whitespace-nowrap rounded-md border border-neutral-300 bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-800"
        aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true"
        @keydown.enter.prevent="openedWithKeyboard = true"
        @keydown.down.prevent="openedWithKeyboard = true"
        :class="isOpen || openedWithKeyboard ? 'text-neutral-900 dark:text-white' :
            'text-neutral-600 dark:text-neutral-300'"
        :aria-expanded="isOpen || openedWithKeyboard">
        <span x-text="ages[selected]"></span>
        <x-heroicon-m-chevron-down class="size-4 rotate-0" />
    </button>
    <!-- Dropdown Menu -->
    <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard"
        @click.outside="isOpen = false, openedWithKeyboard = false"
        @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()"
        class="absolute top-11 left-0 flex min-w-[12rem] flex-col overflow-hidden rounded-md border border-neutral-300 bg-neutral-50 py-1.5 w-full z-999"
        role="menu">
        @foreach ($menus as $menu)
            <button
                class="bg-neutral-50 px-4 text-left py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/10 focus-visible:text-neutral-900 focus-visible:outline-none"
                role="menuitem"
                @click="isOpen = false, selected = '{{ $menu[0] }}', openedWithKeyboard = false, getTable('{{ $menu[0] }}'), openedIndex = {{$loop->index}}">
                {{ $menu[1] }}
            </button>
        @endforeach
    </div>
</div>