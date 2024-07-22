<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import {reactive} from "vue";
    import {router} from "@inertiajs/vue3";
    import TextInput from "@/Components/TextInput.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";

    const form = reactive({
        name: null,
    })

    function submitForm() {
        router.post('/categories', form);
    }
</script>

<template>
    <Head title="Category Add" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Category</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submitForm" class="p-3.5">
                        <InputLabel for="name" value="Name" />
                        <TextInput model-value="name" />

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
