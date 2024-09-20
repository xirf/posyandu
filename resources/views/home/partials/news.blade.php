<div class="w-full max-w-7xl flex flex-col items-center mx-auto gap-8 p-8">
    <h1 class="text-4xl font-black text-center">Daftar Layanan</h1>
    <div class="w-20 h-1 bg-black rounded-full"></div>
    <div class="w-full grid grid-cols-3 gap-8">
        @foreach ($news as $item)
            <div class="bg-white shadow-cyan-200 rounded-lg p-8 grid gap-4 border border-gray-100 relative z-10"
                style="box-shadow: 10px 40px 50px 0 #e5f6f56b">
                <div class="w-20 h-24 flex items-center justify-center">
                    <img src="{{ $item['thumbnail'] }}" alt="">
                </div>
                <h2 class="text-2xl font-bold leading-relaxed">{{ $item['title'] }}</h2>
                <p class="leading-normal text-gray-400">{!! $item['content'] !!}</p>
            </div>
        @endforeach
    </div>
</div>
