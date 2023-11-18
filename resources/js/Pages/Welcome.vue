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
    users:{
        type: Array
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
                    <div>
                        <h2>List of users</h2>
                        <ul>
                            <li v-for="user in users" :key="user.id">{{ user.name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
