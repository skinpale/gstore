<script setup>
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import MainLayout from "@/Layouts/MainLayout.vue";
import {usePage} from "@inertiajs/vue3";

const user = usePage().props.auth.user;

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    favorites: {
        type: Array
    }
});
</script>

<template>
    <MainLayout>
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
                            <span class="ms-1 text-sm font-medium text-gray-400">Профіль</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </template>
        <!--Header-->
        <div class="text-3xl font-bold px-10 py-5 mx-auto max-w-7xl bg-white border-t border-b tracking-wide flex">
            <span class="text-gray-700">Профіль </span>
        </div>

        <div class="mx-auto max-w-7xl bg-white pb-10">
            <div class="py-5 bg-white px-10 rounded-b text-justify">
                <div class="mb-5 border-b pb-3">
                    <div class="pb-4">
                        <span class="text-gray-700 text-2xl font-bold">Ваші дані</span>
                    </div>
                    <div>
                        <span class="text-gray-700 text-xl">{{user.name}}</span>
                    </div>
                    <div>
                        <span class="text-gray-700 text-xl">{{user.email}}</span>
                    </div>
                </div>

                <div class="mb-5 pb-3">
                    <div class="pb-4">
                        <span class="text-gray-700 text-2xl font-bold">Збережені товари</span>
                    </div>
                    <div>
                        <div v-if="favorites.length>0" v-for="(favorite, index) in favorites" :key="favorite.id" class="flex py-2 border-b">
                            <div class="mr-2"><span>{{index+1}}.</span></div>
                            <div><img :src="linkBuilder(favorite.product.vendor_code)" class="h-7 mr-3" alt=""></div>
                            <div><span>{{favorite.product.name}}</span></div>
                            <div class="ml-auto">
                                <svg @click="removeFavorite(index)" class="h-5 w-5 text-gray-500 cursor-pointer hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                        <div v-else>тут поки нічого немає =(</div>

                    </div>
                </div>

                <div>
                    <UpdatePasswordForm class="max-w-xl"/>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script>
export default {
    methods: {
        linkBuilder(code){
            return `/storage/hardware/monitors/${code}/1.webp`
        },
        async removeFavorite(index) {
            try {
                const favoriteId = this.favorites[index].favorite.id;
                await axios.delete(`/api/favorite/${favoriteId}`);
                this.favorites.splice(index, 1);
            } catch (error) {
                console.error('Error deleting favorite:', error);
            }
        },
    }
}
</script>
