<div class="mx-auto w-full max-w-7xl flex flex-col">
    <h2 class="text-2xl font-bold text-gray-800">Aktivitas Terbaru</h2>
    @if ($activities->count() == 1)
        <div class="w-full flex justify-center" style="box-shadow: 10px 40px 50px 0 #e5f6f56b">
            <x-guest.empty header="Tidak Ada Berita Lainnya" message="Sepertinya kami perlukan waktu untuk menyiapkan berita terbaru. Silahkan kembali lagi nanti." />
        </div>
    @endif
    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8 mt-8">
        {{-- iff null --}}
        @foreach ($activities->skip(1) as $item)
            <div class="bg-white shadow-cyan-200 rounded-xl overflow-hidden flex flex-col border border-gray-100 relative z-10"
                style="box-shadow: 10px 40px 50px 0 #e5f6f56b">
                <a href="{{ route('activity.show', $item['slug']) }}">
                    <div
                        class="w-full h-auto aspect-video object-cover flex items-center justify-center relative">
                        <img src="{{ $item['thumbnail'] }}" alt=""
                            class="w-full h-full object-cover aspect-video">
                        {{-- published at --}}
                        <div
                            class="absolute bottom-0 text-xs left-0 bg-cyan-500 text-white px-2 py-1 rounded-tr-lg">
                            {{ $item->getDiff() }}
                        </div>
                    </div>
                    <div class="p-8 flex flex-col gap-3">
                        <h2 class="text-2xl font-bold leading-relaxed line-clamp-2">{{ $item['title'] }}</h2>
                        <p class="leading-normal text-gray-400">{{ $item->getExcerpt(200) }}</p>
                        <p class="text-cyan-500">
                            Baca Selengkapnya...
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
<div class="flex space-x-1 mx-auto items-center justify-center">
    {{ $activities->onEachSide(3)->links() }}
</div>