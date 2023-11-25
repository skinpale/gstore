<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    products: {
        type: Object
    },
    category: {
        type: Object
    },
    subcategory: {
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
                        <a href="/" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-gray-700">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            Додому
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a :href="route('products', {category : category.url})" class="ms-1 text-sm font-medium text-gray-400 hover:text-gray-700">{{category.name}}</a>
                        </div>
                    </li>
                    <li v-if="subcategory" aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a :href="route('products', {category : category.url,
                            subcategory : subcategory.url})"  class="ms-1 text-sm font-medium text-gray-400 hover:text-gray-700">{{ subcategory.name }}</a>
                        </div>
                    </li>
                </ol>
            </nav>

        </template>

        <div class="mx-auto max-w-7xl">
            <div class="mt-5">
                <div v-if="products.data.length > 0">
                    <div class="grid grid-cols-4 gap-4">
                        <a v-for="product in products.data" :key="product.id" :href="route('products.show', {product : product.vendor_code})">
                            <div class="flex flex-col">
                                <div class="bg-white p-5 rounded overflow-hidden shadow-md hover:shadow-2xl">
                                    <!-- Картинка (шаблонная) -->
                                    <img :src="`/storage/hardware/monitors/${product.vendor_code}/1.webp`" alt="Image"
                                         class="w-full rounded object-top mb-4 h-48">

                                    <!-- Название товара -->
                                    <h2 class="text-lg font-semibold line-clamp-2">{{ product.name }}</h2>

                                    <div v-if="product.discount_price" class="mb-2 flex items-center">
                                        <!-- Цена товара -->
                                        <div class="text-gray-700 line-through ml-auto pr-2 ">{{ product.price }} грн</div>
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
                <div v-else>
                    <div class="bg-white py-10 rounded shadow-md flex flex-col items-center">
                        <div class="mx-auto text-2xl">Товарів за таким критерієм не знайдено =(</div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
