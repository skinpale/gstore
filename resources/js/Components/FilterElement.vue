<template>
    <div style="display: flex; align-items: center;">
        <svg v-if="arrowDirection === 'up'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round"
             stroke-linejoin="round"
             style="width: 16px; height: 16px; margin-right: 8px;">
            <path d="M6 15l6-6 6 6"/>
        </svg>
        <svg v-else-if="arrowDirection === 'down'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round"
             stroke-linejoin="round"
             style="width: 16px; height: 16px; margin-right: 8px;">
            <path d="M6 9l6 6 6-6"/>
        </svg>
        <slot />
    </div>
</template>

<script>
export default {
    props: {
        arrowDirection: {
            type: String,
            default: 'down' // Default to 'down' if not specified
        }
    }
}
</script>

