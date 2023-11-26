<template>
    <div id="default-carousel" data-carousel="slide" class="relative pb-10">
        <!-- Carousel wrapper -->
        <div
            v-for="(slide, index) in slides"
            :key="index"
            class="h-96 mx-auto"
            v-show="index === currentSlide"
        >
            <img
                :src="slide"
                class="object-contain h-full w-full p-10 transition-transform transform hover:scale-110"
                alt="..."
                @mouseover="hovered = true"
                @mouseleave="hovered = false"
                @click="openModal"
            />
        </div>

        <!-- Slider indicators -->
        <div
            class="absolute z-30 px-10 flex bottom-2 space-x-3 rtl:space-x-reverse">
            <button v-for="(slide, index) in slides" :key="index" type="button"
                    class="w-15 h-15 outline-2 rounded p-1"
                    :class="{ 'outline': currentSlide === index }"
                    :aria-current="currentSlide === index"
                    :aria-label="`Slide ${index + 1}`"
                    @click="goToSlide(index)">
                <img :src="slide" alt="aboba" class="object-contain h-full w-full ">
            </button>
        </div>

        <!-- Slider controls -->
        <div
            class="absolute top-0 start-5 z-30 flex border-1 items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            @click="prevSlide"
            @mouseover="resetHoverState"
        >
            <span class="hover:bg-gray-100 bg-gray-200 inline-flex items-center  justify-center w-10 h-10 rounded-full">
                <svg class="w-4 h-4 text-black rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/></svg>
                <span class="sr-only">Previous</span>
            </span>
        </div>

        <div
            class="absolute top-0 end-5 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            @click="nextSlide"
            @mouseover="resetHoverState"
        >
            <span class="hover:bg-gray-100 bg-gray-200 inline-flex items-center  justify-center w-10 h-10 rounded-full">
                <svg class="w-4 h-4 text-black rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </div>

        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-30">
            <div @click="closeModal" class="absolute inset-0 cursor-pointer"></div>
            <div class="max-w-full max-h-full overflow-auto rounded-md">
                <img
                    :src="slides[currentSlide]"
                    alt="Fullscreen Image"
                    class="mx-auto max-w-full max-h-full"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        vendor_code: {
            type: String,
        },
    },
    data() {
        return {
            currentSlide: 0,
            slides: [],
            numberOfImages: 0,
            hovered: false,
            showModal: false,
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
        fetchNumberOfImages() {
            axios
                .get(`/api/products/${this.vendor_code}`)
                .then((response) => {
                    this.numberOfImages = response.data.numberOfImages;
                    this.fetchImages();
                })
                .catch((error) => {
                    console.error('Error fetching categories', error);
                });
        },
        fetchImages() {
            for (let i = 1; i <= this.numberOfImages; i++) {
                const imageUrl = `/storage/hardware/monitors/${this.vendor_code}/${i}.webp`;
                this.slides.push(imageUrl);
            }
        },
        openModal() {
            this.showModal = true;
            window.addEventListener('keydown', this.handleKeyDown);
        },
        closeModal() {
            this.showModal = false;
            window.removeEventListener('keydown', this.handleKeyDown);
        },
        handleKeyDown(event) {
            // Handle arrow key presses for image navigation in the modal
            if (this.showModal) {
                if (event.key === 'ArrowLeft') {
                    this.prevSlide();
                } else if (event.key === 'ArrowRight') {
                    this.nextSlide();
                } else if (event.key === 'Escape') {
                    this.closeModal();
                }
            }
        },
    },
    mounted() {
        this.fetchNumberOfImages();
    },
};
</script>

<style scoped>
.hover\:scale-110:hover {
    transform: scale(1.1);
}

.bg-black {
    /* Adjust the background color of the modal overlay */
    background-color: rgba(0, 0, 0, 0.75);
}
</style>
