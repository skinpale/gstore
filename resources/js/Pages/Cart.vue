<script setup>

import MainLayout from "@/Layouts/MainLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    cartItems: {
        type: Array,
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
                    <li class="inline-flex items-center">
                        <span
                           class="inline-flex items-center text-sm font-medium text-gray-400">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            Корзина
                        </span>
                    </li>
                </ol>
            </nav>
        </template>

        <div class="mx-auto max-w-7xl bg-white pb-10 border-t ">
            <div class="py-5 bg-white px-10 rounded-b text-justify">
                <div class="mb-5 pb-3">
                    <div class="pb-4">
                        <span class="text-gray-700 text-2xl font-bold">Товари в корзині</span>
                    </div>
                    <div>
                        <div v-if="cartItems.length>0" v-for="(cartItem, index) in cartItems" :key="cartItem.id" class="flex py-2 border-b">
                            <div class="mr-2"><span>{{index+1}}.</span></div>
                            <div><img :src="linkBuilder(cartItem)" class="h-7 mr-3" alt=""></div>
                            <div class="w-1/2"><a :href="route(`products.show`, {product: cartItem.product.vendor_code})">{{cartItem.product.name}}</a></div>
                            <div class="ml-auto flex items-center">
                                <div class="mr-4">
                                    <span v-if="cartItem.product.discount_price">
                                        <span class="line-through text-sm pr-1">{{cartItem.product.price}}</span>
                                        <span class="text-red-600">{{cartItem.product.discount_price}}</span>
                                    </span>
                                    <span v-else>{{cartItem.product.price}}</span>
                                    <span class="text-md"> x </span>
                                    <span>{{cartItem.cartItem.quantity}}</span>
                                    <span> = </span>
                                    <span v-if="cartItem.product.discount_price">{{cartItem.cartItem.quantity * cartItem.product.discount_price}} грн</span>
                                    <span v-else>{{cartItem.cartItem.quantity * cartItem.product.price}} грн</span>
                                </div>

                                <div class="mr-4">
                                    <button class="border px-2 rounded-md hover:bg-gray-50" @click="decrement(cartItem, index)">-</button>
                                    <span class="px-4">{{cartItem.cartItem.quantity}} шт.</span>
                                    <button class="border px-2 rounded-md hover:bg-gray-50" @click="increment(cartItem)">+</button>
                                </div>
                            </div>
                        </div>
                        <div v-if="cartItems.length>0" class="flex py-5 px-6 border-b">
                            <span class="ml-auto mr-2 text-2xl">Сума:</span>
                            <span class="text-2xl">{{total()}} грн</span>
                        </div>
                        <div v-if="cartItems.length>0" class="py-5">
                            <span class="text-gray-700 text-2xl font-bold">Створити замовлення</span>
                            <div class="pt-5">
                                <PrimaryButton class="w-full border rounded-md hover:bg-gray-50 items-center justify-center" @click="createOrder()">Створити</PrimaryButton>
                            </div>
                        </div>
                        <div v-else>тут поки нічого немає =(</div>
                    </div>
                    <div class="pb-4 mt-5">
                        <span class="text-gray-700 text-2xl font-bold">Ваші замовлення</span>
                    </div>
                    <div v-if="orders.length>0" v-for="(order, index) in orders" :key="order.id" class="py-2">
                        <div class="flex items-center border-b pb-2">
                            <span class="font-bold">Замовлення №{{order.id}}</span>
                            <span class="ml-auto">{{ formatTimestamp(order.created_at) }}</span>
                        </div>
                        <div class="items-center w-full">
                            <div v-for="(cartItem, index) in order.order_items" :key="cartItem.id" class="flex py-2 border-b">
                                <span>{{cartItem.quantity}}шт. - </span>
                                <span class="ml-2"> {{cartItem.product.name}}</span>
                                <span v-if="cartItem.product.discount_price" class="ml-auto">
                                    <span class="line-through text-sm pr-1">{{cartItem.product.price}}</span>
                                    <span class="text-red-600">{{cartItem.product.discount_price}} грн</span>
                                </span>
                                <span v-else class="ml-auto">
                                    <span>{{cartItem.product.price}} грн</span>
                                </span>
                            </div>
                            <div class="flex mt-5 mb-5">
                                <span class="ml-auto text-xl">Сума: {{order.total}} грн</span>
                            </div>
                        </div>
                    </div>
                    <div v-else>тут поки нічого немає =(</div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>


<script>
import moment from "moment";

export default {
    data(){
        return {
            orders: []
        }
    },
    created() {
        this.getOrders()
    },
    methods: {
        getOrders(){
            axios.get('/api/orders')
                .then(response => {
                    this.orders = response.data;
                })
                .catch(error => {
                    console.error('Ошибка при загрузке отзывов:', error);
                });
        },
        linkBuilder(item){
            return `/storage/${item.category.url}/${item.subcategory.url}/${item.product.vendor_code}/1.webp`
        },
        total(){
            return this.cartItems.reduce((total, item) => {
                const itemPrice = item.product.discount_price
                    ? parseFloat(item.product.discount_price)
                    : parseFloat(item.product.price);
                return total + itemPrice * item.cartItem.quantity;
            }, 0);
        },
        async decrement(cartItem, index){
            try {
                const id = cartItem.cartItem.id;
                await axios.post(`/api/cart/decrement/${id}`);
                if(cartItem.cartItem.quantity === 1) this.cartItems.splice(index, 1);
                else cartItem.cartItem.quantity -= 1
            } catch (error) {
                console.error('Error deleting favorite:', error);
            }
        },
        async increment(cartItem){
            try {
                const id = cartItem.cartItem.id;
                await axios.post(`/api/cart/increment/${id}`);
                cartItem.cartItem.quantity += 1
            } catch (error) {
                console.error('Error deleting favorite:', error);
            }
        },
        createOrder(){
            axios.post('/api/order')
            this.getOrders()
            this.cartItems.splice(0, this.cartItems.length)
        },
        formatTimestamp(timestamp) {
            return moment(timestamp).format('YYYY-MM-DD HH:mm:ss');
        }
    }
}
</script>

