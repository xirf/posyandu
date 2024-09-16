<nav aria-label="pagination" class="flex justify-between items-center text-sm font-medium ">
    <div>
        <p>{{ __('Showing') }} <span x-text="`${activeData.from}-${activeData.to}`"></span>
            {{ __('Of') }} <span x-text="activeData.total"></span></p>
    </div>
    <ul class="flex flex-shrink-0 items-center gap-1">
        <template x-for="link in activeData.links" :key="link.label">
            <li>
                <button
                    @click="link.url ? getTable(null, link.url) : null"
                    :class="{ 'bg-cyan-500 text-white': link.active, 'hover:bg-cyan-500 hover:text-white': !link.active }"
                    class="flex size-6 shrink-0 px-2 items-center w-full justify-center rounded-md p-1 text-neutral-600 hover:text-white whitespace-nowrap"
                    x-html="link.label"></button>
            </li>
        </template>
    </ul>
</nav>