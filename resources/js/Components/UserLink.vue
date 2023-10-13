<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    username: {
        type: String,
    },
    href: {
        type: String,
    }
});
</script>

<template>
    <div class="flex gap-1 text-indigo-700 hover:text-indigo-500">
        <svg class="w-4 h-4 pb-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
            <path d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
        </svg>

        <Link :href="href" class="leading-none">{{ username }}</Link>
    </div>
</template>

<style scoped>

</style>
