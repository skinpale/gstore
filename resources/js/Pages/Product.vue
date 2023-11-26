<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Rating from "@/Components/Rating.vue";
import ProductDetails from "@/Components/ProductDetails.vue";
import ProductCarousel from "@/Components/ProductCarousel.vue";
import DetailsTable from "@/Components/DetailsTable.vue";

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

        <!--Main-->
        <div class="mx-auto max-w-7xl">
            <div class="bg-white border-t">
                <div class="grid grid-cols-2 gap-4 pb-5 px-10 overflow-hidden shadow-md">
                    <!--Carousel-->
                    <ProductCarousel :vendor_code="product.vendor_code"></ProductCarousel>

                    <!--Right of view-->
                    <div class="relative">
                        <div class="grid grid-cols-3 overflow-hidden bg-gray-50">
                            <button @click="scrollToSection('description')" class="border-r py-2 text-gray-800 text-md hover:bg-gray-200">Опис</button>
                            <button @click="scrollToSection('characteristics')" class="border-r py-2 text-gray-800 text-md hover:bg-gray-200">Характеристики</button>
                            <button @click="scrollToSection('reviews')" class="border-r py-2 text-gray-800 text-md hover:bg-gray-200">Відгуки</button>
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
            </div>
        </div>

        <!--Description-->
        <div class="mx-auto max-w-7xl">
            <div class="border-t-2 border-dashed bg-white p-5 rounded overflow-hidden shadow-md">
                <section id="description">
                    <div class="text-justify px-14 pt-2">
                        <div class="py-2 flex">
                            <span class="text-3xl font-bold mx-auto">Опис товару</span>
                        </div>
                        <p class="leading-7 mt-5 whitespace-pre-wrap" v-html="product.description"/>
                    </div>
                </section>
            </div>
        </div>

        <!--Characteristics-->
        <div class="mx-auto max-w-7xl">
            <div class="border-t-2 border-dashed bg-white p-5 rounded overflow-hidden shadow-md">
                <section id="characteristics">
                    <div class="text-justify px-14 pt-2">
                        <div class="py-2 flex">
                            <span class="text-3xl font-bold mx-auto">Характеристики</span>
                        </div>
                        <div class="py-5">
                            <DetailsTable :details="JSON.parse(product.details)"></DetailsTable>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </MainLayout>
</template>

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
