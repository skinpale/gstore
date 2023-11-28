<template>
    <div class="bg-white p-6 shadow-md border rounded-lg relative">
        <div class="absolute start-3 top-3 text-sm text-gray-500">
            № {{index}}
        </div>
        <div class="mb-2 mt-4 justify-between flex border-b pb-2 items-center">
            <div class="font-bold text-lg">{{review.username}}</div>
            <StarRating :rating="review.rating" :show-rating="false" :star-size="24" :read-only="true" ></StarRating>
        </div>
        <div class="mb-4">
            <div class="w-full break-words">{{review.comment}}</div>
        </div>
    </div>
</template>

<script>
import StarRating from 'vue-star-rating'

export default {
    props: {
        review: {
            type: Object,
            required: true,
        },
        index: {
            type: Number,
            required: true
        }
    },
    components: {
        StarRating
    }
};
</script>
