<select id="{{ $id }}" name="{{ $name }}"
    class="w-full appearance-none rounded-md border border-neutral-300 bg-neutral-50 px-4 py-2 text-sm focus-visible:outline focus:border-cyan-600 focus:shadow-cyan-600 focus:ring-cyan-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 ">
    {{ $slot }}
</select>
