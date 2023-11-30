<template>
    <div>
        <ul>
            <li v-for="review in reviews" :key="review.id">{{ review  }}</li>
        </ul>
        <form @submit.prevent="submitReview">
            <text-input v-model="rating"></text-input>
            <text-input v-model="comment"></text-input>
            <button type="submit">Отправить отзыв</button>
        </form>
    </div>
</template>

<script>
import TextInput from "@/Components/TextInput.vue";

export default {
    components: {TextInput},
    data() {
        return {
            reviews: [],
            rating: 5,
            comment: "test",
            user_id: 1,
            product_id: 1
        };
    },
    mounted() {
        this.loadReviews();
    },
    methods: {
        loadReviews() {
            // Загрузка отзывов с сервера
            axios.get('/api/reviews')
                .then(response => {
                    this.reviews = response.data;
                })
                .catch(error => {
                    console.error('Ошибка при загрузке отзывов:', error);
                });
        },
        submitReview() {
            // Отправка нового отзыва на сервер
            axios.post('/api/reviews', {
                rating: this.rating,
                comment: this.comment,
            })
                .then(response => {
                    this.reviews.push(response.data);
                })
                .catch(error => {
                    console.error('Ошибка при отправке отзыва:', error);
                });
        },
    },
};
</script>
