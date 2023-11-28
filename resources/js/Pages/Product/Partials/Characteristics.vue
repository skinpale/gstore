<template>
    <div class="text-justify px-14 pt-2">
        <div class="py-2 flex">
            <span class="text-3xl font-bold mx-auto">Характеристики</span>
        </div>
        <div class="py-5">
            <DetailsTable :details="JSON.parse(product.details)"></DetailsTable>
        </div>
    </div>
</template>
<script setup>
import DetailsTable from "@/Components/DetailsTable.vue";

defineProps({
    product: {
        type: Object
    }
})
</script>
