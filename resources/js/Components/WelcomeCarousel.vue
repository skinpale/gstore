<template>
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden md:h-96">
            <!-- Item slides -->
            <transition-group name="fade" tag="div">
                <div v-for="(slide, index) in slides" :key="index" class="duration-700 ease-in-out carousel-item"
                     v-show="index === currentSlide">
                    <img :src="slide" class="absolute block w-full -translate-x-1/2 -translate-y-1/3 top-1/2 left-1/2"
                         alt="...">
                </div>
            </transition-group>
        </div>


        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button v-for="(slide, index) in slides" :key="index" type="button"
                    class="w-4 h-4 rounded-full bg-white transition duration-300"
                    :class="{ 'bg-opacity-40': currentSlide === index }"
                    :aria-current="currentSlide === index"
                    :aria-label="`Slide ${index + 1}`"
                    @click="goToSlide(index)">
            </button>
        </div>


        <!-- Slider controls -->
        <div
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            @click="prevSlide">
      <span
          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/60 group-hover:bg-white/80 group-focus:ring-white">
        <svg class="w-4 h-4 text-black rtl:rotate-180" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
        <span class="sr-only">Previous</span>
      </span>
        </div>

        <div
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            @click="nextSlide">
      <span
          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/60 group-hover:bg-white/80 group-focus:ring-white">
        <svg class="w-4 h-4 text-black rtl:rotate-180" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span class="sr-only">Next</span>
      </span>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currentSlide: 0,
            slides: [
                "https://picsum.photos/id/237/1024/800",
                "https://picsum.photos/id/238/1024/800",
                "https://picsum.photos/id/239/1024/800",
                "https://picsum.photos/id/240/1024/800",
                "https://picsum.photos/id/241/1024/800",
            ],
        };
    },
    methods: {
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        },
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        },
        goToSlide(index) {
            this.currentSlide = index;
        },
    },

};
</script>

<style>
.carousel-item {
    float: left;
    position: relative;
    display: block;
    width: 100%;
    margin-right: -100%;
    backface-visibility: hidden;
}

.carousel-item.active {
    left: 0;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
