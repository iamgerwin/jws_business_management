<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlameIcon from "@/Components/FlameIcon.vue";
import {Head, useForm} from '@inertiajs/vue3';
import {onMounted, ref} from "vue";
import axios from "axios";
import BusinessIcon from "@/Components/BusinessIcon.vue";
import PersonIcon from "@/Components/PersonIcon.vue";

defineProps({
    //
})

let openTasks = ref({});
let completedTasks = ref({});

onMounted(() =>{
    getTasks();
});
const getTasks = () => {
    axios.get(route('api.tasks.index', 'open')).then((response) => {
        openTasks.value =  response.data;
    });
    axios.get(route('api.tasks.index', 'completed')).then((response) => {
        completedTasks.value =  response.data;
    });
};
const taskCompletedForm = useForm({});
const taskOpenForm = useForm({});

const completedTask = (id) => {
    if (confirm('Are you sure you want to tag as completed this task?')) {
        taskCompletedForm.post(route('task.update.status', { task: id, status: 'completed' }), {
            preserveScroll: true,
            onSuccess: () => {
                getTasks();
            },
        });
    }
}

const openTask = (id) => {
    if (confirm('Are you sure you want to re-open this task?')) {
        taskOpenForm.post(route('task.update.status', { task: id, status: 'open' }), {
            preserveScroll: true,
            onSuccess: () => {
                getTasks();
            },
        });
    }
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10">
                        <p class="flex justify-center w-full gap-2 pt-4 font-extrabold text-2xl md:text-3xl dark:text-blue-500">
                            <span>Open</span>
                            <FlameIcon/>
                        </p>

                        <table class="w-full table-fixed">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Task Name</th>
                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">For </th>
                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Status </th>
                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Action </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <tr v-for="item in openTasks" :key="item.id">
                                <td class="py-4 px-6 border-b border-gray-200">{{ item.title }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 truncate ">
                                    <BusinessIcon v-if="item.owner_type === 'business'" />
                                    <PersonIcon v-if="item.owner_type === 'person'" />
                                    {{ item.owner_name }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ item.status.toUpperCase() }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <button @click="completedTask(item.id)" class="bg-green-500 text-white py-1 px-2 rounded-full text-xs">Completed</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr/>
                    <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10">
                        <p class="flex justify-center w-full gap-2 pt-4 font-extrabold text-2xl md:text-3xl dark:text-blue-500">
                            <span>Completed</span>
                            <FlameIcon/>
                        </p>

                        <table class="w-full table-fixed">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Task Name</th>
                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">For </th>
                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Status </th>
                                <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Action </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <tr v-for="item in completedTasks" :key="item.id">
                                <td class="py-4 px-6 border-b border-gray-200">{{ item.title }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 truncate ">
                                    <BusinessIcon v-if="item.owner_type === 'business'" />
                                    <PersonIcon v-if="item.owner_type === 'person'" />
                                    {{ item.owner_name }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ item.status.toUpperCase() }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <button @click="openTask(item.id)" class="bg-red-500 text-white py-1 px-2 rounded-full text-xs">Re-Open</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
