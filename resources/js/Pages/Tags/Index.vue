<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";


defineProps({
    tags: {
        type: Object,
        required: true,
    }
})

const deleteForm = useForm({});

const deleteTag = (id) => {
    if (confirm('Are you sure you want to delete this tag?')) {
        deleteForm.delete(route('tags.destroy', id), {
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <Head title="Tag"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">List of Tags</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-blue overflow-hidden shadow-sm sm:rounded-lg p-2 ">
                        <Link
                            :href="route('tags.create')"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                        >
                            Add Tag
                        </Link>
                    </div>

                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div
                                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                NAME
                                            </th>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                ACTION
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="tag in tags.data" :key="tag.id">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ tag.name }}
                                            </td>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                <Link
                                                    :href="
                                                            route(
                                                                'tags.edit',
                                                                tag.id
                                                            )
                                                        "
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    <primary-button class="mr-1">edit</primary-button>
                                                </Link>
                                                <danger-button @click="deleteTag(tag.id)">delete
                                                </danger-button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
