<template>
    <div class="flex flex-col">
        <div class="bg-white p-5 rounded overflow-hidden shadow-md hover:shadow-2xl relative">
            <!-- Картинка (шаблонная) -->
            <img :src="`/storage/hardware/monitors/${product.vendor_code}/1.webp`" alt="Image"
                 class="w-full rounded object-top mb-4 h-48">

            <!-- Название товара -->
            <h2 class="text-lg font-semibold line-clamp-2">{{ product.name }}</h2>

            <!-- Наявність -->
            <div class="flex my-3">
                <div class="text-sm ml-auto">
                    <span v-if="product.stock_quantity>0">
                        є в наявності
                    </span>
                </div>
            </div>


            <!--Рейтинг-->
            <div class="flex">
                <div class="ml-auto flex items-center">
                    <span class="text-xs">({{ product.rating }})</span>
                    <Rating :rating="product.rating"></Rating>
                </div>
            </div>

            <div v-if="product.discount_price" class="mb-2 flex items-center">
                <!-- Цена товара -->
                <div class="text-gray-700 line-through ml-auto pr-2 ">{{ product.price }} грн
                </div>
                <!-- Цена со скидкой (если есть) -->
                <div class="text-4xl text-red-500">{{ product.discount_price }}
                    <span class="text-2xl">грн</span>
                </div>
            </div>
            <div v-else class="mb-2 flex">
                <!-- Цена товара -->
                <div class="text-4xl text-gray-700 ml-auto">{{ product.price }}
                    <span class="text-2xl">грн</span>
                </div>
            </div>
            <!-- Дополнительные детали, описание и т.д., если необходимо -->
            <div>
                <SecondaryButton class="w-full mx-auto justify-center">Купити</SecondaryButton>
            </div>

            <!--Fire-->
            <div v-if="product.discount_price" class="absolute top-2 end-5">
                <span class="text-5xl">🔥</span>
            </div>
        </div>
    </div>
</template>

<script>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Rating from "@/Components/Rating.vue";

export default {
    components: {Rating, SecondaryButton},
    props: {
        product: {
            type: Object,
            required: true,
        }
    }
}
</script>
