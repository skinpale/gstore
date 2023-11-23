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
    }
});
</script>

<template>
    <MainLayout :can-login="canLogin" :can-register="canRegister">
        <div class="mx-auto max-w-7xl">
            <Carousel/>
            <div class="mt-5">
                <div class="grid grid-cols-4 gap-4 items-center">
                    <SecondaryButton>aboba</SecondaryButton>
                    <SecondaryButton>abiba</SecondaryButton>
                    <SecondaryButton>kaka</SecondaryButton>
                    <SecondaryButton>puka</SecondaryButton>
                    <div v-for="index in 7" :key="index" class="rounded-lg bg-white p-7">
                        <img :src="`/storage/hardware/monitors/TNKKneW4/${index}.webp`" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
