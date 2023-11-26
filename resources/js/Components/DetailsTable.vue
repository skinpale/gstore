<template>
    <table class="w-full">
        <tbody>
        <tr :class="{ 'bg-gray-200': isEven(index), 'bg-white': !isEven(index) }" v-for="(value, key, index) in details" :key="key">
            <td class="border-r">{{ key }}</td>
            <td class="pl-2" v-if="Array.isArray(value)">
                <ul>
                    <li v-for="(item, index) in value" :key="index">{{ item }}</li>
                </ul>
            </td>
            <td class="pl-2" v-else-if="typeof value === 'object'">
                <table>
                    <tbody>
                    <tr v-for="(subValue, subKey) in value" :key="subKey">
                        <td>{{ subKey }}</td>
                        <td v-if="Array.isArray(subValue)">
                            <ul>
                                <li v-for="(item, index) in subValue" :key="index">{{ item }}</li>
                            </ul>
                        </td>
                        <td v-else>{{ subValue }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td class="pl-2" v-else>{{ value }}</td>
        </tr>
        </tbody>
    </table>
</template>


<script>
export default {
    props:{
        details: {
            type: Object,
            required: true
        }
    },
    methods: {
        isEven(index) {
            return index % 2 === 0;
        },
    },
}
</script>
