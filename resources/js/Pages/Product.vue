<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Rating from "@/Components/Rating.vue";
import ProductDetails from "@/Components/ProductDetails.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    product: {
        type: Object
    }
});

</script>

<template>
    <MainLayout :can-login="canLogin" :can-register="canRegister">
        <!-- Bread cramps -->
        <template #header>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="/"
                           class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-gray-700">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            Додому
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a :href="route('products', {category : product.category.url})"
                               class="ms-1 text-sm font-medium text-gray-400 hover:text-gray-700">{{
                                    product.category.name
                                }}</a>
                        </div>
                    </li>
                    <li v-if="product.subcategory" aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a :href="route('products', {category : product.category.url,
                            subcategory : product.subcategory.url})"
                               class="ms-1 text-sm font-medium text-gray-400 hover:text-gray-700">{{
                                    product.subcategory.name
                                }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-400">{{ product.name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

        </template>

        <div class="mx-auto max-w-7xl">
            <div class="mt-5 bg-white">
                <div class="grid grid-cols-2 gap-4 p-5 rounded overflow-hidden shadow-md">
                    <div id="default-carousel" data-carousel="slide" class="relative pb-10">
                        <!-- Carousel wrapper -->
                        <div v-for="(slide, index) in slides" :key="index"
                             class="h-96 mx-auto"
                             v-show="index === currentSlide">
                            <img :src="slide" class="object-contain h-full w-full p-10" alt="...">
                        </div>


                        <!-- Slider indicators -->
                        <div
                            class="absolute z-30 flex -translate-x-1/2 bottom-2 left-1/2 space-x-3 rtl:space-x-reverse">
                            <button v-for="(slide, index) in slides" :key="index" type="button"
                                    class="w-15 h-15 focus:outline outline-1 rounded-full p-1"
                                    :class="{ 'bg-opacity-40': currentSlide === index }"
                                    :aria-current="currentSlide === index"
                                    :aria-label="`Slide ${index + 1}`"
                                    @click="goToSlide(index)">
                                <img :src="slide" alt="aboba" class="object-contain h-full w-full ">
                            </button>
                        </div>


                        <!-- Slider controls -->
                        <div
                            class="absolute top-0 start-5 z-30 flex border-1 items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            @click="prevSlide">
                            <span
                                class="hover:bg-gray-100 bg-gray-200 inline-flex items-center  justify-center w-10 h-10 rounded-full">
                                <svg class="w-4 h-4 text-black rtl:rotate-180" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 1 1 5l4 4"/>
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </div>

                        <div
                            class="absolute top-0 end-5 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            @click="nextSlide">
      <span class="hover:bg-gray-100 bg-gray-200 inline-flex items-center  justify-center w-10 h-10 rounded-full">
        <svg class="w-4 h-4 text-black rtl:rotate-180" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span class="sr-only">Next</span>
      </span>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="text-2xl font-bold pt-10 whitespace-normal">{{ product.name }}</div>
                        <div class="flex py-4">
                            <Rating :rating="product.rating"></Rating>
                            <div class=ml-auto>
                                <span class="text-xs">код для замовлення: </span>
                                <span class="tracking-wide">{{ product.vendor_code }}</span>
                            </div>
                        </div>
                        <div v-if="product.discount_price" class="mb-2 flex items-center absolute bottom-20 end-0">
                            <!-- Цена товара -->
                            <div class="text-gray-700 line-through ml-auto pr-2 text-2xl">{{ product.price }} грн</div>
                            <!-- Цена со скидкой (если есть) -->
                            <div class="text-5xl text-red-500">{{ product.discount_price }}
                                <span class="text-2xl">грн</span>
                            </div>
                        </div>
                        <div v-else class="mb-2 flex">
                            <!-- Цена товара -->
                            <div class="text-5xl text-gray-700 ml-auto">{{ product.price }}
                                <span class="text-2xl">грн</span>
                            </div>
                        </div>
                        <div class="absolute bottom-6 w-full flex justify-end">
                            <button class="bg-gray-200 text-gray-800 rounded-md hover:bg-gray-100 shadow-md text-lg py-2 mx-3 w-1/3">Залишити відгук</button>
                            <button class="bg-gray-800 text-white rounded-md hover:bg-gray-700 text-lg py-2 w-40 shadow-md flex items-center justify-center">
                                В корзину
                                <svg class="w-6 h-6 text-gray-800 dark:text-white ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl">
            <div class="mt-1">
                <div class="grid grid-cols-2 gap-4 bg-white p-5 rounded overflow-hidden shadow-md">
                    <ProductDetails :productDetails="product.details" />
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script>
export default {
    data() {
        return {
            currentSlide: 0,
            slides: [],
            numberOfImages: 0,
        };
    },
    methods: {
        fetchNumberOfImages() {
            axios.get(`/api/products/${this.product.vendor_code}`)
                .then(response => {
                    this.numberOfImages = response.data.numberOfImages;
                    this.fetchImages();
                })
                .catch(error => {
                    console.error('Error fetching categories', error);
                });
        },
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        },
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        },
        goToSlide(index) {
            this.currentSlide = index;
        },
        fetchImages() {
            for (let i = 1; i <= this.numberOfImages; i++) {
                const imageUrl = `/storage/hardware/monitors/${this.product.vendor_code}/${i}.webp`;
                this.slides.push(imageUrl);
            }
        },
    },
    mounted() {
        this.fetchNumberOfImages()
    }

};
</script>
