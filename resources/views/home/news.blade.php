<x-home-layout>
    <div class="w-screen space-y-12 py-14">
        <div class="w-full max-w-7xl mx-auto p-8 grid grid-cols-2 gap-8 rounded-xl bg-white border">
            <img src="{{ $news[0]->thumbnail }}" alt="{{ $news[0]->title }}"
                class="h-full aspect-video object-cover rounded-xl border">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    <img src="{{ $news[0]->user->picture }}" alt="{{ $news[0]->user->name }}"
                        class="h-8 w-8 object-cover rounded-full">
                    <div class="font-medium text-sm text-gray-500">{{ $news[0]->user->name }} &middot;
                        {{ $news[0]->created_at->diffForHumans() }}</div>
                </div>
                <h1 class="text-4xl font-bold text-gray-800">{{ $news[0]->title }}</h1>
                <p class="text-gray-600 mt-4">{{ $news[0]->getExcerpt(300) }}</p>
                <a href="{{ route('news.show', $news[0]->id) }}" class="text-blue-500 mt-4">Read More</a>
            </div>
        </div>
        <div class="mx-auto w-full max-w-7xl flex flex-col">
            <h2 class="text-2xl font-bold text-gray-800">Berita Terbaru</h2>
            <div class="grid grid-cols-3 gap-8 mt-8">
                @foreach ($news->skip(1) as $item)
                    <div class="bg-white shadow-cyan-200 rounded-xl overflow-hidden flex flex-col border border-gray-100 relative z-10"
                        style="box-shadow: 10px 40px 50px 0 #e5f6f56b">
                        <a href="{{ route('news.show', $item['slug']) }}">
                            <div
                                class="w-full h-auto aspect-video object-cover flex items-center justify-center relative">
                                <img src="{{ $item['thumbnail'] }}" alt=""
                                    class="w-full h-full object-cover aspect-video">
                                {{-- published at --}}
                                <div
                                    class="absolute bottom-0 text-xs left-0 bg-cyan-500 text-white px-2 py-1 rounded-tr-lg">
                                    {{ $item->created_at->diffForHumans() }}
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
    </div>
</x-home-layout>
