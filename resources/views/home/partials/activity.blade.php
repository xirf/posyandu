<div class="w-full px-32 py-8">

    <div x-data="{
        slides: [{
                imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-1.webp',
                imgAlt: 'Vibrant abstract painting with swirling blue and light pink hues on a canvas.',
            },
            {
                imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-2.webp',
                imgAlt: 'Vibrant abstract painting with swirling red, yellow, and pink hues on a canvas.',
            },
            {
                imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-3.webp',
                imgAlt: 'Vibrant abstract painting with swirling blue and purple hues on a canvas.',
            },
        ],
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
    }" class="relative w-full overflow-hidden space-y-4 max-w-7xl mx-auto">

        <div class="relative min-h-[50svh] w-full rounded-xl bg-cyan-500 overflow-hidden" x-on:touchstart="handleTouchStart($event)"
            x-on:touchmove="handleTouchMove($event)" x-on:touchend="handleTouchEnd()">
            <template x-for="(slide, index) in slides">
                <div x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.700ms>

                </div>
            </template>
        </div>

        <div class="flex items-center justify-center gap-10">
            <button type="button" aria-label="next slide" x-on:click="previous()">
                <x-heroicon-o-arrow-left class="w-8 h-8 text-cyan-500" />
            </button>

            <div class="rounded-md flex gap-8 bg-white/75 px-1.5 py-1 md:px-2 " role="group"
                aria-label="slides">
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
