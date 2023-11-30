<template>
    <div class="text-justify px-10 pt-2">
        <div class="py-2 flex">
            <span class="text-3xl font-bold mx-auto">Відгуки ({{reviewsAmountRef}})</span>
        </div>


        <div v-if="reviews.length>0" class="py-2 grid grid-cols-2 border-t border-dotted mb-5 mt-5">
            <div v-for="(review, index) in reviews" key="review.id" class="m-4">
                <ReviewCard :review="review" :index="index+1"/>
            </div>
        </div>
        <div v-else class="flex py-2 border-b border-t border-dotted mb-5 mt-5">
            <span class="mx-auto">тут поки нічого немає, будьте першим!</span>
        </div>

        <form v-if="user" @submit.prevent="submitReview" class="p-2">
            <div class="rounded-md shadow-md pt-4">
                <div class="flex items-center border-b mx-6 justify-between">
                    <label class="block text-gray-700 text-lg mb-2">Оцінка</label>
                    <StarRating v-model:rating="rating" :show-rating="false" :star-size="30" class="mb-3"></StarRating>
                </div>
                <div class="bg-white px-6 pb-6 rounded-lg shadow-md">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-lg mb-2 mt-2">Коментарій</label>
                        <textarea v-model="comment" class="w-full h-16 px-3 py-2 rounded-md" required></textarea>
                    </div>
                    <div class="flex">
                        <PrimaryButton class="w-full justify-center" type="submit">
                            Залишити відгук
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </form>

    </div>
</template>

<script setup>
import ReviewCard from "@/Components/ReviewCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import StarRating from "vue-star-rating";
import { usePage } from "@inertiajs/vue3";
import {ref} from "vue";

const { product, reviews, reviewsAmount } = defineProps(['product', 'reviews', 'reviewsAmount']);
const user = usePage().props.auth.user;

let rating = 0;
let comment = "";
let product_id = product.id;
const reviewsAmountRef = ref(reviewsAmount);

const submitReview = async () => {
    try {
        let user_id = user.id
        const response = await axios.post('/api/reviews', {
            rating,
            comment,
            user_id,
            product_id
        });

        // Обновляем reviews после успешной отправки отзыва
        reviews.push(response.data.review);
        reviewsAmountRef.value += 1
        // Очищаем rating и comment после успешной отправки отзыва
        rating = 0;
        comment = '';
    } catch (error) {
        console.error('Ошибка при отправке отзыва:', error);
    }
};
</script>
