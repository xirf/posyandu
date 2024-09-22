<a href="{{ route('activity.show', $activities[0]->slug) }}">
    <div class="w-full max-w-7xl mx-auto p-8 grid  md:grid-cols-2 gap-8 rounded-xl bg-white border">
        <img src="{{ $activities[0]->thumbnail }}" alt="{{ $activities[0]->title }}"
            class="h-full aspect-video object-cover rounded-xl border">
        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-3 mb-2">
                <img src="{{ $activities[0]->user->picture }}" alt="{{ $activities[0]->user->name }}"
                    class="w-6 h-6 md:h-8 md:w-8 object-cover rounded-full">
                <div class="font-medium text-sm text-gray-500">{{ $activities[0]->user->name }} &middot;
                    {{ $activities[0]->getDiff() }}</div>
            </div>
            <h1 class="text-4xl font-bold text-gray-800">{{ $activities[0]->title }}</h1>
            <p class="text-gray-600 mt-4">{{ $activities[0]->getExcerpt(300) }}</p>
            <a href="{{ route('activity.show', $activities[0]->id) }}" class="text-blue-500 mt-4">Baca Selengkapnya...</a>
        </div>
    </div>
</a>