<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import InputError from "@/Components/InputError.vue";
    import {onMounted, ref} from "vue";
    import axios from "axios";
    import MultipleSelectSubtitle from "@/Components/MultipleSelectSubtitle.vue";

    const form = useForm({
        name: null,
        email: null,
        category_ids: null,
        tag_ids: null,
    })

    let tags = ref({});
    let categories = ref({});
    const getTags = () => {
        axios.get(route('api.tags.index')).then((response) => {
            tags.value = response.data;
        });
    };

    const getCategories = () => {
        axios.get(route('api.categories.index')).then((response) => {
            categories.value = response.data;
        });
    };

    onMounted(() => {
        getCategories();
        getTags();
    });

    const submit = () => {
        form.post(route('businesses.store'), {
            preserveScroll: true,
        });
    };
</script>

<template>
    <Head title="Add Business" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Business</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-blue overflow-hidden shadow-sm sm:rounded-lg p-2 ">
                        <Link
                            :href="route('businesses.index')"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                        >
                            List Business
                        </Link>
                    </div>
                    <form @submit.prevent="submit" class="p-3.5">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    for="name"
                                    class="block text-sm font-medium text-gray-700"
                                >Business Name</label
                                >
                                <input
                                    v-model="form.name"
                                    type="text"
                                    id="name"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.name,
                                            }"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
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
                                    for="business_id"
                                    class="block text-sm font-medium text-gray-700"
                                >Categories</label
                                >
                                <select
                                    v-model="form.category_ids"
                                    id="tag_ids"
                                    class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.category_ids,
                                            }"
                                    multiple
                                >
                                    <option
                                        v-for="item in categories.data"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.category_ids"
                                />
                                <MultipleSelectSubtitle />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    for="tag_ids"
                                    class="block text-sm font-medium text-gray-700"
                                >Tags</label
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
