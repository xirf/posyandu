<x-home-layout>
    <div class="w-screen space-y-8 lg:space-y-12 p-8 lg:py-14">
        @if ($activities->count() == 0)
            <x-guest.empty header="Tidak Ada Aktivitas Lainnya"
                message="Sepertinya kami perlukan waktu untuk menyiapkan aktivitas terbaru. Silahkan kembali lagi nanti." />
        @else
            @include(activity . partials . hero)
            @include(activity . partials . related)
        @endif
    </div>
</x-home-layout>
