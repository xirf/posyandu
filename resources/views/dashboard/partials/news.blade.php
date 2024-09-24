<div class="rounded-xl shadow bg-white p-8 w-full">
    <div class="flex items-center justify-between">
        <span tabindex="0" class="focus:outline-none text-xl font-bold text-gray-800">{{ __('News') }}</span>
        <a href="{{route('dashboard.news.new') }}">
            <div class="flex items-center">
                <x-heroicon-o-plus class="w-5 h-5 text-gray-800 cursor-pointer" />
            </div>
        </a>
    </div>
    <div class="mt-4 relative w-full 2xl:w-96">
        @if (count($news) === 0)
            <x-empty :text="__('No News')" :description="__('No news found try to add one')">
                <a href="{{ route('dashboard.news.new') }}" class="w-full flex justify-center">
                    <x-primary-button>
                        {{ __('Add') }}
                    </x-primary-button>
                </a>
            </x-empty>
        @else
            @foreach ($news as $newsItem)
                <div class="flex items-center justify-between py-4 border-b border-gray-300 border-dashed">
                    <div>
                        <a href="{{route('news.show', $newsItem['slug'])}}
                            <h3 class="text-lg font-semibold line-clamp-2 text-gray-800">{{ $newsItem->title }}</h3>
                        </a>
                        <p class="text-sm text-cyan-700">{{ $newsItem->getDiff() }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
