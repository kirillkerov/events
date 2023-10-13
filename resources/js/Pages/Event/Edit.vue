<script setup>
import {Head, router, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {reactive} from "vue";

defineProps({
    event: {
        type: Object
    }
});

const event = usePage().props.event;

const form = reactive({
    name: event.name,
    description: event.description,
})

function update() {
    router.patch(route('event.update', event.id), form)
}
</script>

<template>
    <Head title="Edit Event" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Events / Edit</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="asd">
                                Тут что-то будет ...
                            </div>

                            <form class="space-y-5" @submit.prevent="update">
                                <div>
                                    <label class="font-medium" for="name">Название</label>
                                    <input type="text" id="name" required v-model="form.name" class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"/>
                                </div>
                                <div>
                                    <label class="font-medium" for="description">Описание</label>
                                    <textarea id="description" v-model="form.description" class="w-full mt-2 h-36 px-3 py-2 resize-none appearance-none bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"></textarea>
                                </div>
                                <button class="px-4 py-2 text-white font-medium bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-600 rounded-lg duration-150">Обновить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
