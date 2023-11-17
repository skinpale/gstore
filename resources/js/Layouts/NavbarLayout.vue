<script setup>
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});
</script>

<template>
    <nav class="bg-white border-b border-gray-100 shadow">
        <!-- Top menu-->
        <div class="max-w-7xl mx-auto border-b pb-2">
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
                        <NavLink href="#" :active="route().current('/')">Про нас</NavLink>
                        <NavLink href="#">Магазини</NavLink>
                        <NavLink href="#">Гарантія</NavLink>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="max-w-7xl mx-auto">
            <div class="flex h-16 items-center">

                <!-- Categories -->
                <div class="relative">
                    <Dropdown align="left" width="48">
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
                            <DropdownLink :href="route('profile.edit')">#</DropdownLink>
                        </template>
                    </Dropdown>
                </div>
                <!-- Search field -->
                <div class="w-1/2 ms-6">
                    <form>
                        <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="search"
                                   class="block w-full p-1.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
                                   placeholder="Пошук товарів" required>
                        </div>
                    </form>
                </div>
                <!-- Auth -->
                <div v-if="canLogin" class="ml-auto text-end">
                    <PrimaryButton>Вийти</PrimaryButton>

                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('logout')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        method="post"
                        as="button"
                    >выйти
                    </Link
                    >

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Log in
                        </Link
                        >

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Register
                        </Link
                        >
                    </template>
                </div>
            </div>
        </div>
    </nav>
</template>
