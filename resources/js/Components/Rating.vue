<template>
    <div class="flex items-center">
        <template v-for="index in 5" :key="index">
            <svg
                v-if="index <= rating"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                class="h-6 w-6 text-yellow-500"
            >
                <path
                    fill-rule="evenodd"
                    d="M10 2.585L12.121 6.75l3.829.558c.9.13 1.26 1.225.61 1.863l-2.77 2.677.655 3.825c.15.875-.71 1.505-1.422 1.114L10 14.33l-3.424 1.798c-.714.377-1.572-.24-1.422-1.114l.655-3.825-2.77-2.677c-.65-.638-.29-1.733.61-1.863L7.879 6.75 10 2.585z"
                />
            </svg>
            <svg
                v-else
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                class="h-6 w-6 text-gray-300"
            >
                <path
                    fill-rule="evenodd"
                    d="M10 2.585L12.121 6.75l3.829.558c.9.13 1.26 1.225.61 1.863l-2.77 2.677.655 3.825c.15.875-.71 1.505-1.422 1.114L10 14.33l-3.424 1.798c-.714.377-1.572-.24-1.422-1.114l.655-3.825-2.77-2.677c-.65-.638-.29-1.733.61-1.863L7.879 6.75 10 2.585zM10 4.318l-2.145 2.08.502 2.92-2.098-1.102-2.176 1.14 1.377 1.335-.323 1.883 1.982-1.04 2.05 1.984-.308-1.798 1.385-.596 2.915-2.145-2.08L10 4.318z"
                />
            </svg>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        rating: {
            type: Number,
            required: true,
            default: 0,
        },
    },
};
</script>
