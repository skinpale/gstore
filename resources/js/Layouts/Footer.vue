<template>
    <footer class="bg-white shadow mt-auto">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">GGSTORE™</a></span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <NavLink :href="route('about')" class="me-4 md:me-6">Про нас</NavLink>
                </li>
                <li>
                    <NavLink :href="route('points')" class="me-4 md:me-6">Магазини</NavLink>
                </li>
                <li>
                    <NavLink :href="route('guarantee')" class="me-4 md:me-6">Гарантія</NavLink>
                </li>
            </ul>
        </div>
    </footer>
</template>
<script setup>
import NavLink from "@/Components/NavLink.vue";
</script>
