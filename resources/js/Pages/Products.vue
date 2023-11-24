<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    products: {
        type: Object
    }
});
</script>

<template>
    <MainLayout :can-login="canLogin" :can-register="canRegister">
        <div class="mx-auto max-w-7xl">
            <div class="mt-5">
                <div class="grid grid-cols-4 gap-4 items-center">
                    <div>
                    <h1>Products</h1>

                    <!-- Отображение товаров -->
                    <div v-if="products.data.length > 0">
                        <ul>
                            <li v-for="product in products.data" :key="product.id">
                                {{ product.name }} - {{ product.price }}
                            </li>
                        </ul>
                    </div>

                    <!-- Пагинация -->
                    <Link :href="'/hardware?page=' + products.current_page" v-if="products.last_page > 1">
                        Page {{ products.current_page }} of {{ products.last_page }}
                    </Link>
                </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
