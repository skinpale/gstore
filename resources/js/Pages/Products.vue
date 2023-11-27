<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductCard from "@/Components/ProductCard.vue";
import "./Products.vue";

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
                            <a :href="route('products', {category : category.url})"
                               class="ms-1 text-sm font-medium text-gray-400 hover:text-gray-700">{{
                                    category.name
                                }}</a>
                        </div>
                    </li>
                    <li v-if="subcategory" aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a :href="route('products', {category : category.url,
                            subcategory : subcategory.url})"
                               class="ms-1 text-sm font-medium text-gray-400 hover:text-gray-700">{{
                                    subcategory.name
                                }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </template>

        <!--Header-->
        <div class="text-3xl font-bold px-10 py-5 mx-auto max-w-7xl bg-white border-t tracking-wide">
            <span v-if="subcategory" class="text-gray-700">{{ subcategory.name }}</span>
            <span v-else class="text-gray-700">{{ category.name }}</span>
        </div>

        <!--Content-->
        <div class="mx-auto max-w-7xl bg-white rounded-b border-t px-10 pb-3">
            <!--Cards-->
            <div class="mt-5">
                <div v-if="products.data.length > 0">
                    <div class="grid grid-cols-4 gap-4">
                        <a v-for="product in products.data" :key="product.id"
                           :href="route('products.show', {product : product.vendor_code})">
                            <ProductCard :product="product"></ProductCard>
                        </a>
                    </div>
                </div>
                <div v-else>
                    <div class="bg-white py-10 rounded shadow-md flex flex-col items-center">
                        <div class="mx-auto text-2xl">Товарів за таким критерієм не знайдено =(</div>
                    </div>
                </div>
            </div>
            <!--Pagination-->
            <div class="flex my-10 items-center">
                <div class="mx-auto flex">
                    <div class="ml-auto">
                        <button v-if="products.current_page !== 1"
                                class="px-4 outline-1 outline rounded-full outline-gray-300 mr-3 hover:bg-gray-100"
                                @click="goToLink(products.prev_page_url)">
                            &laquo;
                        </button>
                    </div>
                    <div class="flex items-center">
                        <div v-for="link in products.links.slice(1,products.last_page+1)" :key="link.label">
                            <button
                                :class="[ 'px-4', 'outline-1', 'outline', 'rounded-full', 'outline-gray-300', {'bg-gray-800': link.active}, {'text-white': link.active},{'hover:bg-gray-100' : !link.active}]"
                                :disabled="link.active"
                                @click="goToLink(link.url)"
                                v-html="link.label">
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button v-if="products.current_page !== products.last_page"
                                class="px-4 outline-1 outline rounded-full outline-gray-300 ml-3 hover:bg-gray-100"
                                @click="goToLink(products.next_page_url)">
                            &raquo;
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script>
export default {
    methods: {
        goToLink(url) {
            window.location.href = url;
        }
    }
}
</script>
