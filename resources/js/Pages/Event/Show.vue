<script setup>
import {Head, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link} from "@inertiajs/vue3";
import UserLink from "@/Components/UserLink.vue";
import EventsBreadcrumbs from "@/Components/EventsBreadcrumbs.vue";

defineProps({
    event: {
        type: Object
    },
});

const event = usePage().props.event;
const socketId = Echo.socketId();

const breadcrumbs = [
    {
        'label': 'События',
        'route': route('event.index'),
    },
    {
        'label': event.name,
    },
]

const user = usePage().props.auth.user;
</script>

<template>
    <Head title="Events" />

    <AuthenticatedLayout>
        <EventsBreadcrumbs :items="breadcrumbs"/>

        <div class="my-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <article v-if="event" class="flex flex-col items-start justify-between border-2 border-gray-100 rounded-lg p-6">
                            <div class="w-full flex justify-between gap-4 flex-wrap-reverse">
                                <UserLink href="#" :username="event.user.name"/>

                                <span class="text-gray-500 text-xs justify-self-end">{{ event.created }}</span>
                            </div>

                            <div class="content">
                                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900">
                                    {{ event.name }}
                                </h3>
                                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ event.description }}</p>
                            </div>

                            <div v-if="event.user.id === user.id" class="w-full flex justify-end text-xs gap-4">
                                <Link :href="route('event.edit', event.id)" class="text-sky-700 hover:text-sky-500">Редактировать</Link>
                                <Link :href="route('event.delete', event.id)" :headers="{ 'X-Socket-ID': socketId }" class="text-red-700 hover:text-red-500">Удалить</Link>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
