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
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-400">Про нас</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </template>
        <!--Header-->
        <div class="text-3xl font-bold px-10 py-5 mx-auto max-w-7xl bg-white border-t border-b tracking-wide flex">
            <span class="text-gray-700">Про нас </span>
        </div>

        <div class="mx-auto max-w-7xl bg-white pb-10">
            <div class="py-5 bg-white px-10 rounded-b text-justify">
                <p class="text-lg text-gray-600 leading-7 whitespace-pre-wrap">Ласкаво просимо до нашого ігрового універсуму, де кожен гравець знаходить щось особливе для себе! Ми - команда ентузіастів, які доторкнулися до світу геймінгу та вирішили поділитися своєю пристрастю з вами.</p>
                <br>
                <p class="text-lg text-gray-600 leading-7 whitespace-pre-wrap">У нашому асортименті ви знайдете найкращі ігрові атрибутики для всіх платформ - від консолей до ПК. Ми прагнемо надавати тільки високоякісні товари від провідних виробників геймінгової індустрії, щоб забезпечити вам найкращий геймплей та найбільше задоволення від ігор.</p>
                <br>
                <p class="text-lg text-gray-600 leading-7 whitespace-pre-wrap">Наша мета - не просто продавати атрибутику, але й створювати спільноту гравців, де кожен може знайти товар за своїм смаком та знайти нових друзів, які цінують ігровий світ так само, як і ви.</p>
                <br>
                <p class="text-lg text-gray-600 leading-7 whitespace-pre-wrap">Обирайте найкраще для свого геймплею разом з нами! Запрошуємо вас іммерсивно зануритися в світ ігор разом із нашим інтернет-магазином геймінгової атрибутики. Дозвольте собі бути кращим гравцем!</p>
            </div>
        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
</script>
