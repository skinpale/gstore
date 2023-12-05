<template>
    <div class="grid grid-cols-2 gap-4 pb-5 px-10 overflow-hidden shadow-md relative">
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
                <button v-if="!isFavoriteRef" @click="addFavorite"
                    class="bg-gray-50 text-gray-800 rounded-md hover:bg-gray-100 text-lg py-2 mx-3 w-full">
                    ❤️ В бажане
                </button>
                <button v-else class="bg-gray-200 text-gray-800 rounded-md text-lg py-2 mx-3 w-full" disabled>
                    ✅ В бажаному
                </button>
                <button
                    @click="addCart"
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
            <transition name="fade">
                <div v-if="isModalVisible">
                    <div
                        @click="onToggle"
                        class="absolute inset-0 z-0"
                    ></div>
                    <div
                        class="w-full max-w-md p-2 relative mx-auto rounded-xl shadow-lg bg-red-300 translate-y-24"
                    >
                        <div>
                            <div class="text-center p-1 flex-auto justify-center leading-6 flex items-center">
                                <p class="text-md text-white px-8">
                                    Спочатку потрібно увійти в обліковий запис
                                </p>
                                <svg @click="onToggle" class="h-5 w-5 text-white cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <transition name="fade">
                <div v-if="isModalVisible2">
                    <div
                        @click="onToggle2"
                        class="absolute inset-0 z-0"
                    ></div>
                    <div
                        class="w-full max-w-md p-2 relative mx-auto rounded-xl shadow-lg bg-green-500 translate-y-24"
                    >
                        <div>
                            <div class="text-center p-1 flex-auto justify-center leading-6 flex items-center">
                                <p class="text-md text-white px-8">
                                    Товар додано в корзину
                                </p>
                                <svg @click="onToggle2" class="h-5 w-5 text-white cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>
<script setup>
import Rating from "@/Components/Rating.vue";
import ProductCarousel from "@/Components/ProductCarousel.vue";
import {usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";
const { product, reviewsAmount, isFavorite } = defineProps(['product', 'reviewsAmount', 'isFavorite']);
const user = usePage().props.auth.user;
const isFavoriteRef = ref(isFavorite);

const scrollToSection = (sectionId) => {
    document.getElementById(sectionId).scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
};

const addFavorite = async () => {
    if(user) {
        await axios.post('/api/favorite', {
            product_id: product.id
        });

        isFavoriteRef.value = true
    }
    else{
        onToggle();
    }
};

const addCart = async () => {
    if(user) {
        await axios.post('/api/cart', {
            product_id: product.id
        });
        onToggle2();
    }
    else{
        onToggle();
    }
};

const isOpen = ref(false);

const isModalVisible = computed(() => isOpen.value);

const onToggle = () => {
    isOpen.value = !isOpen.value;
};

const isOpen2 = ref(false);

const isModalVisible2 = computed(() => isOpen2.value);

const onToggle2 = () => {
    isOpen2.value = !isOpen2.value;
};
</script>

