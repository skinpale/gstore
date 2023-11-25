<template>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <tbody>
            <tr v-for="(value, attribute) in productDetails" :key="attribute">
                <td class="py-2 px-4 border-b font-medium">{{ attribute }}</td>
                <td class="py-2 px-4 border-b">{{ formatValue(value) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        productDetails: {
            type: Object,
            required: true,
        },
    },
    methods: {
        formatValue(value) {
            if (Array.isArray(value)) {
                return value.join(", ");
            } else if (typeof value === "object") {
                // Handle nested objects (e.g., "Габарити монітора, маса")
                return Object.entries(value)
                    .map(([key, val]) => `${key}: ${val}`)
                    .join("<br>");
            } else {
                return value;
            }
        },
    },
};
</script>
