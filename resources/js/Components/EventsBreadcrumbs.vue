<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    items: {
        required: true,
        type: Array,
    },
});

</script>

<template>
    <div class="my-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol v-for="(item, index) in items" class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <div v-if="index === items.length - 1" class="flex items-center">
                            <svg v-if="index > 0" class="w-3 h-2 text-gray-400 mx-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="text-sm font-normal text-gray-500">{{ item.label }}</span>
                        </div>

                        <div v-else class="flex items-center">
                            <svg v-if="index > 0" class="w-3 h-2 text-gray-400 mx-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <Link :href="item.route" class="text-sm font-normal text-gray-700 hover:text-blue-600">
                                {{ item.label }}
                            </Link>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</template>

<style scoped>

</style>
