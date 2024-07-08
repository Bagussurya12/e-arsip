<template>
    <Head :title="'Edit Data Terusan - ' + terusan.value" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Edit Data Terusan
            </h3>
        </template>
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-Dark">
                    <form @submit.prevent="submitForm">
                        <div class="mb-4">
                            <InputLabel
                                for="value"
                                class="block text-lg text-Dark font-medium mb-2"
                            >
                                Nama Data
                            </InputLabel>
                            <TextInput
                                type="text"
                                id="value"
                                v-model="form.value"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none"
                                required
                                autofocus
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.value"
                            />
                        </div>

                        <div class="flex justify-end">
                            <Link
                                :href="route('terusan')"
                                class="bg-Biru text-white font-bold py-2 px-4 rounded mr-2"
                            >
                                Batal
                            </Link>
                            <button
                                type="submit"
                                class="bg-Orange hover:text-white text-white font-bold py-2 px-4 rounded"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { defineProps } from "vue";

const props = defineProps({
    terusan: Object,
});
const form = useForm({
    value: props.terusan.value,
});

function submitForm() {
    form.put(route("terusan.update", props.terusan.id), {
        onSuccess: () => {
            Inertia.visit(route("terusan"));
        },
    });
}
</script>
