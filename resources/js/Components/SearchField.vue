<template>
    <form @submit.prevent="handleSubmit">
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
                   placeholder="Пошук товарів (за назвою)" required
                   @keydown.enter="handleSubmit">
        </div>
    </form>
</template>

<script>
export default {
    methods: {
        handleSubmit() {
            const searchTerm = document.getElementById('search').value;
            window.location.href = route('search', {q: searchTerm});
        }
    }
}
</script>
