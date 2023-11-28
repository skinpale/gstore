<template>
    <div class="grid grid-cols-2 gap-4 pb-5 px-10 overflow-hidden shadow-md">
        <!--Carousel-->
        <ProductCarousel :vendor_code="product.vendor_code"></ProductCarousel>

        <!--Right of view-->
        <div class="relative">
            <div class="grid grid-cols-3 overflow-hidden bg-gray-50">
                <button @click="scrollToSection('description')" class="border-r py-2 text-gray-800 text-md hover:bg-gray-200">Опис</button>
                <button @click="scrollToSection('characteristics')" class="border-r py-2 text-gray-800 text-md hover:bg-gray-200">Характеристики</button>
                <button @click="scrollToSection('reviews')" class="border-r py-2 text-gray-800 text-md hover:bg-gray-200">Відгуки ({{reviewsAmount}})</button>
            </div>
            <div class="text-2xl font-bold mt-4 whitespace-normal text-justify">{{ product.name }}</div>
            <div class="flex py-4 items-center">
                <Rating :rating="product.rating"></Rating>
                <span class="text-lg ml-2">({{ product.rating }}/5)</span>
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
            <div v-else class="mb-2 flex items-center absolute bottom-20 end-0">
                <!-- Цена товара -->
                <div class="text-5xl text-gray-700 ml-auto">{{ product.price }}
                    <span class="text-2xl">грн</span>
                </div>
            </div>
            <div class="absolute bottom-5 w-full flex justify-end">
                <button
                    class="bg-gray-50 text-gray-800 rounded-md hover:bg-gray-100 text-lg py-2 mx-3 w-full">
                    ❤️ В бажане
                </button>
                <button
                    class="bg-gray-800 text-white rounded-md hover:bg-gray-700 text-lg py-2 w-full shadow-md flex items-center justify-center">
                    В корзину
                    <svg class="w-6 h-6 text-gray-800 dark:text-white ml-2" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>
<script setup>
import Rating from "@/Components/Rating.vue";
import ProductCarousel from "@/Components/ProductCarousel.vue";

defineProps({
    product: {
        type: Object
    },
    reviewsAmount: {
        type: Number
    }
})
</script>


<script>
export default {
    methods: {
        scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        },
    },
};
</script>

