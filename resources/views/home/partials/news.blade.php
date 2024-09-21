<div class="w-full max-w-7xl flex flex-col items-center mx-auto gap-8 p-8">
    <h1 class="text-4xl font-black text-center">Berita Terbaru</h1>
    <div class="w-20 h-1 bg-black rounded-full"></div>
    <div class="w-full grid grid-cols-3 gap-8">
        @foreach ($news as $item)
            <div class="bg-white shadow-cyan-200 rounded-xl overflow-hidden flex flex-col border border-gray-100 relative z-10"
                style="box-shadow: 10px 40px 50px 0 #e5f6f56b">
                <a href="{{ route('news.show', $item['slug']) }}">
                    <div class="w-full h-auto aspect-video object-cover flex items-center justify-center relative">
                        <img src="{{ $item['thumbnail'] }}" alt=""
                            class="w-full h-full object-cover aspect-video">
                        {{-- published at --}}
                        <div class="absolute bottom-0 text-xs left-0 bg-cyan-500 text-white px-2 py-1 rounded-tr-lg">
                            {{ $item->getPublishedAtAttribute($item['published_at']) }}
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
    <div>
        <a href="{{ route('news.index') }}" class="btn btn-primary btn-outline rounded-full font-bold px-8">Lihat Semua Berita</a>
    </div>
</div>
