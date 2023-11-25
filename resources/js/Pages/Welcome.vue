<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Carousel from "@/Components/WelcomeCarousel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Footer from "@/Layouts/Footer.vue";
import ProductCard from "@/Components/ProductCard.vue";

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
                           :href="route('products.show', {product : product.vendor_code})">
                            <ProductCard :product="product"></ProductCard>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
