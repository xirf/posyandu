<x-home-layout>
    <div class="w-screen space-y-32">
        @include('home.partials.hero')
        @include('home.partials.services')
        @if ($activities)
            @include('home.partials.activity')
        @endif
        @if ($news)
            @include('home.partials.news')
        @endif
    </div>
</x-home-layout>
