<x-home-layout>
    <div class="w-screen space-y-8 lg:space-y-12 p-8 lg:py-14">
        @if ($news->count() == 0)

            <div class="w-full flex justify-center" style="box-shadow: 10px 40px 50px 0 #e5f6f56b">
                <x-guest.empty header="Tidak Ada Berita Lainnya"
                    message="Sepertinya kami perlukan waktu untuk menyiapkan berita terbaru. Silahkan kembali lagi nanti." />
            </div>
        @else
            <a href="{{ route('news.show', $news[0]->slug) }}">
                <div class="w-full max-w-7xl mx-auto p-8 grid  md:grid-cols-2 gap-8 rounded-xl bg-white border">
                    <img src="{{ $news[0]->thumbnail }}" alt="{{ $news[0]->title }}"
                        class="h-full aspect-video object-cover rounded-xl border">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-3 mb-2">
                            <img src="{{ $news[0]->user->picture }}" alt="{{ $news[0]->user->name }}"
                                class="w-6 h-6 md:h-8 md:w-8 object-cover rounded-full">
                            <div class="font-medium text-sm text-gray-500">{{ $news[0]->user->name }} &middot;
                                {{ $news[0]->getDiff() }}</div>
                        </div>
                        <h1 class="text-4xl font-bold text-gray-800">{{ $news[0]->title }}</h1>
                        <p class="text-gray-600 mt-4">{{ $news[0]->getExcerpt(300) }}</p>
                        <a href="{{ route('news.show', $news[0]->id) }}" class="text-blue-500 mt-4">Read More</a>
                    </div>
                </div>
            </a>
            <div class="mx-auto w-full max-w-7xl flex flex-col">
                <h2 class="text-2xl font-bold text-gray-800">Berita Terbaru</h2>
                @if ($news->count() == 1)
                    <div class="w-full flex justify-center" style="box-shadow: 10px 40px 50px 0 #e5f6f56b">
                        <x-guest.empty header="Tidak Ada Berita Lainnya"
                            message="Sepertinya kami perlukan waktu untuk menyiapkan berita terbaru. Silahkan kembali lagi nanti." />
                    </div>
                @endif
                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8 mt-8">
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
                                        {{ $item->getDiff() }}
                                    </div>
                                </div>
                                <div class="p-8 flex flex-col gap-3">
                                    <h2 class="text-2xl font-bold leading-relaxed line-clamp-2">{{ $item['title'] }}
                                    </h2>
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
                {{ $news->onEachSide(3)->links() }}
            </div>
        @endif
    </div>

</x-home-layout>
