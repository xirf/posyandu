<div class="w-full px-32 py-8">
    <div x-data="{
        slides: [
            @foreach ($activities as $activity)
                {
                    title: '{{ $activity['title'] }}',
                    description: '{{ $activity['content'] }}',
                    image: '{{ $activity['thumbnail'] }}',
                    link: '{{ $activity['slug'] }}',
                }, @endforeach
        ],
        init() {
            console.log(this.slides)
        },
        currentSlideIndex: 1,
        touchStartX: null,
        touchEndX: null,
        swipeThreshold: 50,
        previous() {
            if (this.currentSlideIndex > 1) {
                this.currentSlideIndex = this.currentSlideIndex - 1
            } else {
                // If it's the first slide, go to the last slide           
                this.currentSlideIndex = this.slides.length
            }
        },
        next() {
            if (this.currentSlideIndex < this.slides.length) {
                this.currentSlideIndex = this.currentSlideIndex + 1
            } else {
                // If it's the last slide, go to the first slide    
                this.currentSlideIndex = 1
            }
        },
        handleTouchStart(event) {
            this.touchStartX = event.touches[0].clientX
        },
        handleTouchMove(event) {
            this.touchEndX = event.touches[0].clientX
        },
        handleTouchEnd() {
            if (this.touchEndX) {
                if (this.touchStartX - this.touchEndX > this.swipeThreshold) {
                    this.next()
                }
                if (this.touchStartX - this.touchEndX < -this.swipeThreshold) {
                    this.previous()
                }
                this.touchStartX = null
                this.touchEndX = null
            }
        },
        renderDelta(delta) {
            const sanitizedDelta = delta.replace(/\n/g, '\\n');
            try {
                const parsedDelta = JSON.parse(sanitizedDelta);
                return this.extractTextFromDelta(parsedDelta);
            } catch (e) {
                console.error('Error parsing JSON:', e);
                return '';
            }
        },
        extractTextFromDelta(delta) {
            return delta.map(op => op.insert || '').join('');
        }
    }" class="relative w-full space-y-4 max-w-7xl mx-auto">

        <div class="relative min-h-[50svh] w-full rounded-xl bg-cyan-500"
            x-on:touchstart="handleTouchStart($event)" x-on:touchmove="handleTouchMove($event)"
            x-on:touchend="handleTouchEnd()">
            <template x-for="(slide, index) in slides">
                <div x-show="currentSlideIndex == index + 1" class="absolute inset-0 flex flex-col items-center gap-8 p-8"
                    x-transition.opacity.duration.700ms>
                    <h3 class="text-white font-black text-4xl shrink-0">Aktivitas Terbaru</h3>
                    <div class="w-20 h-1 bg-white rounded-full shrink-0"></div>
                    <div class="grid grid-cols-2 gap-8 grow-0 overflow-hidden">
                        <img x-bind:src="slide.image" alt=""
                            class="aspect-video h-full object-cover rounded-lg">
                        <div class="h-full flex flex-col gap-4">
                            <h1 x-text="slide.title"
                                class="text-white line-clamp-2 truncate text-2xl font-black capitalize"></h1>
                            <p x-text="renderDelta(slide.description)" class="text-white line-clamp-4 truncate"></p>
                            <div>
                                <a x-bind:href="slide.link"
                                    class="py-2 px-4 border border-white text-white rounded-full">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <img src="/images/grids.svg" class="absolute -top-10 -right-10 h-32 w-32 brightness-200 grayscale-0"
                alt="">
        </div>
        <img src="/images/grids.svg" class="absolute bottom-0 -left-20 h-32 w-32" alt="">

        <div class="flex items-center justify-center gap-10">
            <button type="button" aria-label="next slide" x-on:click="previous()">
                <x-heroicon-o-arrow-left class="w-8 h-8 text-cyan-500" />
            </button>

            <div class="rounded-md flex gap-8 bg-white/75 px-1.5 py-1 md:px-2 " role="group" aria-label="slides">
                <template x-for="(slide, index) in slides">
                    <button class="size-2 cursor-pointer rounded-full transition"
                        x-on:click="currentSlideIndex = index + 1"
                        x-bind:class="[currentSlideIndex === index + 1 ? 'bg-cyan-500 ' :
                            'bg-cyan-500/25 '
                        ]"
                        x-bind:aria-label="'slide ' + (index + 1)"></button>
                </template>
            </div>

            <button type="button" aria-label="next slide" x-on:click="next()">
                <x-heroicon-o-arrow-right class="w-8 h-8 text-cyan-500" />
            </button>
        </div>


    </div>
</div>
