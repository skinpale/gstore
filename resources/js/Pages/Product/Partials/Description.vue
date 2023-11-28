<template>
    <div class="text-justify px-14 pt-2">
        <div class="py-2 flex">
            <span class="text-3xl font-bold mx-auto">Опис товару</span>
        </div>
        <p class="leading-7 mt-5 whitespace-pre-wrap" v-html="product.description"/>
    </div>
</template>
<script setup>
defineProps({
    product: {
        type: Object
    }

})
</script>
