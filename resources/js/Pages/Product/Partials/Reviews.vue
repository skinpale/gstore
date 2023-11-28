<template>
    <div class="text-justify px-10 pt-2">
        <div class="py-2 flex">
            <span class="text-3xl font-bold mx-auto">Відгуки ({{reviewsAmount}})</span>
        </div>
        <div v-if="reviews.length>0" class="py-2 grid grid-cols-2 border-b border-t border-dotted mb-5 mt-5">
            <div v-for="(review, index) in reviews" key="review.id" class="m-4">
                <ReviewCard :review="review" :index="index"/>
            </div>
        </div>
        <div v-else class="flex py-2 border-b border-t border-dotted mb-5 mt-5">
            <span class="mx-auto">тут поки нічого немає, будьте першим!</span>
        </div>
<!--        <form @submit.prevent="submit" class="p-2">-->
<!--            <div class="rounded-md shadow-md pt-4">-->
<!--                <div class="flex items-center border-b mx-6 justify-between">-->
<!--                    <label class="block text-gray-700 text-lg mb-2">Оцінка</label>-->
<!--                    <StarRating :show-rating="false" :star-size="30" class="mb-3"></StarRating>-->
<!--                </div>-->
<!--                <div class="bg-white px-6 pb-6 rounded-lg shadow-md">-->
<!--                    <div class="mb-4">-->
<!--                        <label class="block text-gray-700 text-lg mb-2 mt-2">Коментарій</label>-->
<!--                        <textarea class="w-full h-16 px-3 py-2 rounded-md"></textarea>-->
<!--                    </div>-->
<!--                    <div class="flex">-->
<!--                        <PrimaryButton class="w-full justify-center" type="submit">-->
<!--                            Залишити відгук-->
<!--                        </PrimaryButton>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
    </div>
</template>

<script setup>
import ReviewCard from "@/Components/ReviewCard.vue";
import StarRating from "vue-star-rating";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    product: {
        type: Object
    },
    reviews: {
        type: Object
    },
    reviewsAmount: {
        type: Number
    }
})
</script>
