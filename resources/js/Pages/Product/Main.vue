<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import ShortInfo from "@/Pages/Product/Partials/ShortInfo.vue";
import Description from "@/Pages/Product/Partials/Description.vue";
import Characteristics from "@/Pages/Product/Partials/Characteristics.vue";
import Reviews from "@/Pages/Product/Partials/Reviews.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    product: {
        type: Object
    },
    reviews: {
        type: Object
    },
    amount: {
        type: Number
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
                        <a href="/public"
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
                <ShortInfo :product="product" :reviews-amount="amount"/>
            </div>
        </div>

        <!--Description-->
        <div class="mx-auto max-w-7xl">
            <div class="border-t-2 border-dashed bg-white p-5 rounded overflow-hidden shadow-md">
                <section id="description">
                    <Description :product="product"/>
                </section>
            </div>
        </div>

        <!--Characteristics-->
        <div class="mx-auto max-w-7xl">
            <div class="border-t-2 border-dashed bg-white p-5 rounded overflow-hidden shadow-md">
                <section id="characteristics">
                    <Characteristics :product="product"/>
                </section>
            </div>
        </div>

        <!--Reviews-->
        <div class="mx-auto max-w-7xl pb-14">
            <div class="border-t-2 border-dashed bg-white p-5 rounded overflow-hidden shadow-md ">
                <section id="reviews">
                    <Reviews :product="product" :reviews="reviews" :reviews-amount="amount"/>
                </section>
            </div>
        </div>
    </MainLayout>
</template>
