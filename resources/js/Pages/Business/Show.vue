<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
    import InputError from "@/Components/InputError.vue";
    import {onMounted, ref} from "vue";
    import axios from "axios";

    defineProps({
        //
    })

    const business = usePage().props.business.data;
    let tasks = ref({});
    const statuses = ['open', 'completed'];
    const form = useForm({
        title: null,
        description: null,
        status: 'open',
    })

    onMounted(() =>{
        getTasks();
    });
    const getTasks = () => {
        axios.get(route('api.task.show', ['business', business.id])).then((response) => {
            tasks.value =  response.data;
        });
    };
    const submit = () => {
        form.post(route('business.tasks.store', business.id), {
            preserveScroll: true,
            onSuccess: () => {
                getTasks();
            },
        });
        form.reset();
    };
</script>

<template>
    <Head title="Business Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Business {{ business.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-blue overflow-hidden shadow-sm sm:rounded-lg p-2 ">
                        <Link
                            :href="route('businesses.index')"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                        >
                            List Businesses
                        </Link>
                    </div>
                    <div class="mx-auto">
                        <div class="bg-white overflow-hidden shadow rounded-lg border">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Business Profile
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    This is some information about the business.
                                </p>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                                <dl class="sm:divide-y sm:divide-gray-200">
                                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Business name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{  business.name }}
                                        </dd>
                                    </div>
                                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Email address
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{  business.email }}
                                        </dd>
                                    </div>
                                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Categories
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <span v-for="item in business.categories" :key="item.id">
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ item.name }}</span>
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">

                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 m-5 sm:p-0 grid grid-cols-6 gap-6">
                        <form @submit.prevent="submit" class="p-3.5 col-span-3 sm:col-span-2">
                            <div class="max-w-xl mx-auto mt-16 flex w-full flex-col border rounded-lg bg-white p-8">
                                <h2 class="title-font mb-1 text-lg font-medium text-gray-900">Add Task</h2>
                                <p class="mb-5 leading-relaxed text-gray-600 lg:text-sm">Want to add some task for the business?</p>
                                <div class="mb-4">
                                    <label for="title" class="text-sm leading-7 text-gray-600">Title</label>
                                    <input
                                        v-model="form.title"
                                        type="text"
                                        id="title"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.title,
                                            }"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.title"
                                    />
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="text-sm leading-7 text-gray-600">Description</label>
                                    <textarea
                                        v-model="form.description"
                                        id="description"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.description,
                                            }"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.description"
                                    />
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="text-sm leading-7 text-gray-600">Status</label>
                                    <select
                                        v-model="form.status"
                                        id="status"
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.status,
                                            }"
                                    >
                                        <option
                                            v-for="item in statuses"
                                            :key="item"
                                            :value="item"
                                        >
                                            {{ item.toUpperCase() }}
                                        </option>
                                    </select>
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.status"
                                    />
                                </div>
                                <button class="rounded border-0 bg-indigo-500 py-2 px-6 text-lg text-white hover:bg-indigo-600 focus:outline-none">Send</button>
                                <p class="mt-3 text-xs text-gray-500">Feel free to connect with us on social media platforms.</p>
                            </div>
                        </form>
                        <div class="col-span-4 sm:col-span-4 max-w-xl mx-auto mt-16 flex w-full flex-col border rounded-lg bg-white p-8">
                            <h2 class="title-font mb-1 text-lg font-medium text-gray-900">Tasks List</h2>
<!--task tile-->
                            <ul v-for="item in tasks" class="bg-white rounded-lg shadow divide-y divide-gray-200 max-w-sm m-1">
                                <li class="px-6 py-4">
                                    <div class="flex justify-between">
                                        <span class="font-semibold text-lg">{{ item.title }}</span>
                                        <span v-if="item.status === 'completed'" class="bg-green-100 text-green-800 text-xs font-medium me-1 px-3 py-1.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ item.status?.toUpperCase() }}</span>
                                        <span v-if="item.status === 'open'" class="bg-blue-100 text-blue-800 text-xs font-medium me-1 px-3 py-1.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ item.status?.toUpperCase() }}</span>
                                    </div>
                                    <p class="text-gray-700">{{ item.description }}</p>
                                </li>
                            </ul>
                            <div v-if="!tasks.length" class="no-file-found flex flex-col items-center justify-center py-8 px-4 text-center bg-gray-100 dark:bg-green-800 rounded-lg shadow-md">
                                <svg class="w-12 h-12 dark:text-gray-400 text-gray-700" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg"><g id="File_Off"><g><path d="M4,3.308a.5.5,0,0,0-.7.71l.76.76v14.67a2.5,2.5,0,0,0,2.5,2.5H17.44a2.476,2.476,0,0,0,2.28-1.51l.28.28c.45.45,1.16-.26.7-.71Zm14.92,16.33a1.492,1.492,0,0,1-1.48,1.31H6.56a1.5,1.5,0,0,1-1.5-1.5V5.778Z"></path><path d="M13.38,3.088v2.92a2.5,2.5,0,0,0,2.5,2.5h3.07l-.01,6.7a.5.5,0,0,0,1,0V8.538a2.057,2.057,0,0,0-.75-1.47c-1.3-1.26-2.59-2.53-3.89-3.8a3.924,3.924,0,0,0-1.41-1.13,6.523,6.523,0,0,0-1.71-.06H6.81a.5.5,0,0,0,0,1Zm4.83,4.42H15.88a1.5,1.5,0,0,1-1.5-1.5V3.768Z"></path></g></g></svg>
                                <h3 class="text-xl font-medium mt-4 text-gray-700 dark:text-gray-200">NO TASKS</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-2">
                                    The task list you are looking for could not be located.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
