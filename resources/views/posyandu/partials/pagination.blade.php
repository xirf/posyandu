<nav aria-label="pagination" class="flex justify-between items-center text-sm font-medium ">
    <div>
        <p>{{ __('Showing') }} <span x-text="`${activeData.from}-${activeData.to}`"></span>
            {{ __('Of') }} <span x-text="activeData.total"></span></p>
    </div>
    {{-- <ul class="flex flex-shrink-0 items-center gap-1">
        <template x-for="link in activeData.links" :key="link.label">
            <li>
                <button
                    @click="link.url ? getTable(null, link.url) : null"
                    :class="{ 'bg-cyan-500 text-white': link.active, 'hover:bg-cyan-500 hover:text-white': !link.active }"
                    class="flex size-6 shrink-0 px-2 items-center w-full justify-center rounded-md p-1 text-neutral-600 hover:text-white whitespace-nowrap"
                    x-html="link.label"></button>
            </li>
        </template>
    </ul>'' --}}
    <div class="flex items-center gap-8">
        <x-secondary-button @click="getTable(null, activeData.prev_page_url)" x-show="activeData.prev_page_url">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
          </svg>
        </x-secondary-button>
       
        <p class="text-slate-600">
          {{-- Page <strong class="text-slate-800">1</strong> of&nbsp;<strong class="text-slate-800">10</strong> --}}
          {{ __('Page') }} <strong x-text="activeData.current_page"></strong> {{ __('Of') }} <strong x-text="activeData.last_page"></strong>
        </p>
        
        <x-secondary-button @click="getTable(null, activeData.next_page_url)" x-show="activeData.next_page_url">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
          </svg>
        </x-secondary-button>
      </div>
</nav>