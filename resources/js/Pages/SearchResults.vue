<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductCard from "@/Components/ProductCard.vue";
import "./Products.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import DropdownSimple from "@/Components/DropdownSimple.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import FilterElement from "@/Components/FilterElement.vue";

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
    amount: {
        type: Object
    },
    search: {
        type: Object
    }
});
</script>

<template>
    <MainLayout :can-login="canLogin" :can-register="canRegister">
        <!--Header-->
        <div class="font-bold px-10 py-5 mx-auto max-w-7xl bg-white border-t tracking-wide flex-col">
            <div>
                <span class="text-3xl text-gray-700">Результат пошуку - {{ search }}</span>
            </div>
            <div>
                <span class="text-gray-700">Знайдено результатів - ({{ amount }})</span>
            </div>
        </div>

        <!--Content-->
        <div class="mx-auto max-w-7xl bg-white rounded-b border-t px-10 pb-3">
            <!--Filters-->
            <div v-if="products.data.length>0" class="flex mt-10 mb-5">
                <div class="ml-auto">
                    <DropdownSimple>
                        <template #trigger>
                             <span class="inline-flex rounded-md">
                                <SecondaryButton
                                    type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium transition ease-in-out duration-150 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                                     сортувати за
                                    <svg class="ms-2 -me-0.5 h-4 w-4"
                                         xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </SecondaryButton>
                            </span>
                        </template>

                        <template #content>
                            <!--Price-->
                            <div>
                                <!--asc-->
                                <div>
                                    <DropdownLink :href="formSortRoute('price', 'asc')">
                                        <FilterElement arrow-direction="up">Ціна</FilterElement>
                                    </DropdownLink>
                                </div>
                                <!--desc-->
                                <div>
                                    <DropdownLink :href="formSortRoute('price')">
                                        <FilterElement arrow-direction="down">Ціна</FilterElement>
                                    </DropdownLink>
                                </div>
                            </div>
                            <!--Rating-->
                            <div>
                                <!--asc-->
                                <div>
                                    <DropdownLink :href="formSortRoute('rating', 'asc')">
                                        <FilterElement arrow-direction="up">Рейтинг</FilterElement>
                                    </DropdownLink>
                                </div>
                                <!--desc-->
                                <div>
                                    <DropdownLink :href="formSortRoute('rating')">
                                        <FilterElement arrow-direction="down">Рейтинг</FilterElement>
                                    </DropdownLink>
                                </div>
                            </div>
                            <!--Amount-->
                            <div>
                                <!--asc-->
                                <div>
                                    <DropdownLink :href="formSortRoute('stock_quantity', 'asc')">
                                        <FilterElement arrow-direction="up">Кількість</FilterElement>
                                    </DropdownLink>
                                </div>
                                <!--desc-->
                                <div>
                                    <DropdownLink :href="formSortRoute('stock_quantity')">
                                        <FilterElement arrow-direction="down">Кількість</FilterElement>
                                    </DropdownLink>
                                </div>
                            </div>
                        </template>
                    </DropdownSimple>
                </div>
            </div>

            <!--Cards-->
            <div>
                <div v-if="products.data.length > 0">
                    <div class="grid grid-cols-4 gap-4">
                        <a v-for="product in products.data" :key="product.id"
                           :href="route('products.show', {product : product.vendor_code})">
                            <ProductCard :product="product"></ProductCard>
                        </a>
                    </div>
                </div>
                <div v-else>
                    <div class="bg-white py-10 flex flex-col items-center">
                        <div class="mx-auto text-2xl">Товарів за таким критерієм не знайдено =(</div>
                    </div>
                </div>
            </div>
            <!--Pagination-->
            <div v-if="products.data.length>0" class="flex my-10 items-center">
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
                                :class="[ 'px-4', 'mx-0.5', 'outline-1', 'outline', 'rounded-full', 'outline-gray-300', {'bg-gray-800': link.active}, {'text-white': link.active},{'hover:bg-gray-100' : !link.active}]"
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

        {{console.log(products)}}
    </MainLayout>
</template>

<script>
export default {
    methods: {
        goToLink(url) {
            window.location.href = url;
        },
        formSortRoute(sortBy, sortOrder) {
            return route('search', { q: this.search, by: sortBy, as: sortOrder });
        }
    }
}
</script>
