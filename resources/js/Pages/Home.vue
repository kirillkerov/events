<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    title: {
        type: String
    },
});
</script>

<template>
    <Head :title=title />

    <AuthenticatedLayout>
        <div class="my-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Тут что-то будет однажды ...</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
