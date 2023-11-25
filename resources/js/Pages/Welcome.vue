<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Carousel from "@/Components/Carousel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Footer from "@/Layouts/Footer.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    products: {
        type: Array
    }
});
</script>

<template>
    <MainLayout :can-login="canLogin" :can-register="canRegister">
        <div class="mx-auto max-w-7xl">
            <Carousel class="py-5"/>
            <div class="py-5">
                <div v-if="products.length > 0">
                    <div class="grid grid-cols-4 gap-4">
                        <a v-for="product in products" :key="product.id"
                           :href="route('products.show', {product : product.id})">
                            <div class="flex flex-col">
                                <div class="bg-white p-5 rounded overflow-hidden shadow-md hover:shadow-2xl">
                                    <!-- Картинка (шаблонная) -->
                                    <img :src="`/storage/hardware/monitors/${product.vendor_code}/1.webp`" alt="Image"
                                         class="w-full rounded object-top mb-4 h-48">

                                    <!-- Название товара -->
                                    <h2 class="text-lg font-semibold line-clamp-2">{{ product.name }}</h2>

                                    <div v-if="product.discount_price" class="mb-2 flex items-center">
                                        <!-- Цена товара -->
                                        <div class="text-gray-700 line-through ml-auto pr-2 ">{{ product.price }} грн
                                        </div>
                                        <!-- Цена со скидкой (если есть) -->
                                        <div class="text-4xl text-red-500">{{ product.discount_price }}
                                            <span class="text-2xl">грн</span>
                                        </div>
                                    </div>
                                    <div v-else class="mb-2 flex">
                                        <!-- Цена товара -->
                                        <div class="text-4xl text-gray-700 ml-auto">{{ product.price }}
                                            <span class="text-2xl">грн</span>
                                        </div>
                                    </div>
                                    <!-- Дополнительные детали, описание и т.д., если необходимо -->
                                    <div>
                                        <SecondaryButton class="w-full mx-auto justify-center">Купити</SecondaryButton>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
