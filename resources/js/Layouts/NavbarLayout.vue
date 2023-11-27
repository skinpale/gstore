<script setup>
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SearchField from "@/Components/SearchField.vue";
import DropdownCatalogue from "@/Components/DropdownCatalogue.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});
</script>

<script>
export default {
    data() {
        return {
            categories: [],
            subcategories: []
        };
    },
    created() {
        this.fetchCategories();
        this.fetchSubCategories();
    },
    methods: {
        fetchCategories() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data.categories;
                })
                .catch(error => {
                    console.error('Error fetching categories', error);
                });
        },
        fetchSubCategories() {
            axios.get('/api/subcategories')
                .then(response => {
                    this.subcategories = response.data.subcategories;
                })
                .catch(error => {
                    console.error('Error fetching categories', error);
                });
        },
        hasSubcategories(categoryId) {
            // Check if there are subcategories for the given category
            return this.subcategories.some((subcategory) => subcategory.category_id === categoryId);
        },
        getSubcategories(categoryId) {
            // Return an array of subcategories for the given category
            return this.subcategories.filter((subcategory) => subcategory.category_id === categoryId);
        },
    },
};
</script>

<template>
    <nav class="bg-white border-b border-gray-100 shadow">
        <!-- Top menu-->
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex my-3">
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('/')">
                            <ApplicationLogo class="block w-auto fill-current text-gray-800"/>
                        </Link>
                    </div>
                </div>

                <!-- Additional Links -->
                <div class="flex items-center">
                    <div class="space-x-4">
                        <NavLink href="#" :active="route().current('#')">Про нас</NavLink>
                        <NavLink href="#" :active="route().current('#')">Магазини</NavLink>
                        <NavLink href="#" :active="route().current('#')">Гарантія</NavLink>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="max-w-7xl mx-auto">
            <div class="flex h-16 items-center">

                <!-- Categories -->
                <div class="relative">
                    <DropdownCatalogue align="left" content-classes="bg-gray-900">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <PrimaryButton
                                    type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium transition ease-in-out duration-150 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                                     Категорії
                                    <svg class="ms-2 -me-0.5 h-4 w-4"
                                         xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </PrimaryButton>
                            </span>
                        </template>

                        <template #content>
                            <div class="grid grid-cols-2">
                                <div v-for="category in categories" :key="category.id">
                                    <DropdownLink :href="route('products', { category: category.url })" class="hover:bg-red-500 rounded">
                                        <span class="text-xl font-bold text-white">{{ category.name }}</span>
                                    </DropdownLink>
                                    <div v-if="hasSubcategories(category.id)">
                                        <div v-for="subcategory in getSubcategories(category.id)" :key="subcategory.id">
                                            <DropdownLink
                                                :href="route('products', { category: category.url, subcategory: subcategory.url })"
                                                class="hover:bg-red-500 rounded"
                                            >
                                                <span class="text-white text-md">{{ subcategory.name }}</span>
                                            </DropdownLink>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </DropdownCatalogue>
                </div>
                <!-- Search field -->
                <div class="w-full ms-6">
                    <SearchField></SearchField>
                </div>
                <!-- Auth -->
                <div v-if="canLogin" class="ml-4 text-end">
                    <div v-if="$page.props.auth.user" class="flex items-center">
                        <!--Profile-->
                        <Link :href="route('/')">
                            <SecondaryButton class="h-9 ml-3">
                                <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3.656 12.115a3 3 0 0 1 5.682-.015M13 5h3m-3 3h3m-3 3h3M2 1h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Zm6.5 4.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                                </svg>
                            </SecondaryButton>
                        </Link>
                        <!--Cart-->
                        <Link :href="route('/')">
                            <SecondaryButton class="h-9 ml-3">
                                <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1"
                                          d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                                </svg>
                            </SecondaryButton>
                        </Link>
                        <!--Logout-->
                        <Link :href="route('logout')" method="post" as="button">
                            <SecondaryButton class="h-9 ml-3">
                                <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 18 15">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1"
                                          d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3"/>
                                </svg>
                            </SecondaryButton>
                        </Link>
                    </div>

                    <template v-else>
                        <div class="flex items-center ml-3">
                            <Link :href="route('login')"><PrimaryButton>Увійти</PrimaryButton></Link>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="ms-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                <PrimaryButton>Зареєструватися</PrimaryButton>
                            </Link>

                        </div>
                    </template>
                </div>
            </div>
        </div>
    </nav>
</template>
