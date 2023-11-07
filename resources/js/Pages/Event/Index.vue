<script setup>
import {Head, Link, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UserLink from "@/Components/UserLink.vue";

defineProps({
    events: {
        type: Array
    },
    title: {
        type: String
    },
});

Echo.channel('store_event').listen('.store_event', (e) => {
    usePage().props.events.unshift(e.event);
});

Echo.channel('delete_event').listen('.delete_event', (e) => {
    const events = usePage().props.events;
    const index = events.findIndex(event => event.id === e.event_id);
    if (index !== -1) {
        events.splice(index, 1);
    }
});

</script>

<template>
    <Head :title=title />

    <AuthenticatedLayout>
        <div class="my-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-3">
                            <Link
                                :href="route('event.create')"
                                as="button"
                                type="button"
                                class="px-4 py-2 text-white bg-indigo-600 rounded duration-150 hover:bg-indigo-500 active:bg-indigo-700"
                            >
                                Создать событие
                            </Link>
                        </div>

                        <div id="events" class="grid gap-4">
                            <article v-for="event in events" class="flex flex-col items-start justify-between border-2 border-gray-100 rounded-lg p-6">
                                <div class="w-full flex justify-between gap-4 flex-wrap-reverse">
                                    <UserLink href="#" :username="event.user.name"/>

                                    <span class="text-gray-500 text-xs justify-self-end">{{ event.created }}</span>
                                </div>

                                <div class="mt-3">
                                    <h3 class="text-lg font-semibold leading-6 text-gray-700 hover:text-gray-500">
                                        <Link :href="route('event.show', event.id)">
                                            {{ event.name }}
                                        </Link>
                                    </h3>
                                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ event.description }}</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
