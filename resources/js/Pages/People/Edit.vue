<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {onMounted, ref} from "vue";
import axios from "axios";
import MultipleSelectSubtitle from "@/Components/MultipleSelectSubtitle.vue";

defineProps({

});

const person = usePage().props.person.data;
const tag_ids = usePage().props.tag_ids;

const form = useForm({
    first_name: person.first_name,
    last_name: person.last_name,
    email: person.email,
    phone: person.phone,
    business_id: person.business_id,
    tag_ids: tag_ids,
})

let tags = ref({});
let businesses = ref({});
const getTags = () => {
    axios.get(route('api.tags.index')).then((response) => {
        tags.value = response.data;
    });
};

const getBusinesses = () => {
    axios.get(route('api.businesses.index')).then((response) => {
        businesses.value = response.data;
    });
};

onMounted(() => {
    getBusinesses();
    getTags();
});

const submit = () => {
    form.put(route('people.update', person.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Person Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Person</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-blue overflow-hidden shadow-sm sm:rounded-lg p-2 ">
                        <Link
                            :href="route('people.index')"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                        >
                            List People
                        </Link>
                    </div>
                    <form @submit.prevent="submit" class="p-3.5">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    for="first_name"
                                    class="block text-sm font-medium text-gray-700"
                                >First Name</label
                                >
                                <input
                                    v-model="form.first_name"
                                    type="text"
                                    id="first_name"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.first_name,
                                            }"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.first_name"
                                />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    for="last_name"
                                    class="block text-sm font-medium text-gray-700"
                                >Last Name</label
                                >
                                <input
                                    v-model="form.last_name"
                                    type="text"
                                    id="last_name"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.last_name,
                                            }"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.last_name"
                                />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    for="email"
                                    class="block text-sm font-medium text-gray-700"
                                >Email</label
                                >
                                <input
                                    v-model="form.email"
                                    type="text"
                                    id="email"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.email,
                                            }"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    for="phone"
                                    class="block text-sm font-medium text-gray-700"
                                >Phone</label
                                >
                                <input
                                    v-model="form.phone"
                                    type="text"
                                    id="phone"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.phone,
                                            }"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.phone"
                                />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    for="business_id"
                                    class="block text-sm font-medium text-gray-700"
                                >Business</label
                                >
                                <select
                                    v-model="form.business_id"
                                    id="business_id"
                                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.business_id,
                                            }"
                                >
                                    <option value="" selected="selected">
                                        Select a Business
                                    </option>
                                    <option
                                        v-for="item in businesses.data"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.business_id"
                                />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    for="tag_ids"
                                    class="block text-sm font-medium text-gray-700"
                                >Tag</label
                                >
                                <select
                                    v-model="form.tag_ids"
                                    id="tag_ids"
                                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.tag_ids,
                                            }"
                                    multiple
                                >
                                    <option
                                        v-for="item in tags.data"
                                        :key="item.id"
                                        :value="item.id"
                                        :selected="tag_ids.includes(item.id)"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tag_ids"
                                />
                                <MultipleSelectSubtitle />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Submit
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
