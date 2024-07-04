<template>
    <div>
        <Head title="Edit Tema" />
        <AuthenticatedLayout class="w-full">
            <template #header>
                <h2 class="font-semibold text-lg text-gray-Dark leading-tight">
                    Edit Tema
                </h2>
            </template>

            <div class="py-12">
                <div class="w-full mx-auto sm:px-6 lg:px-8">
                    <section>
                        <header class="m-6 space-y-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                Edit Tema
                            </h2>
                            <div
                                class="w-full border-t border-slate-700 my-10"
                            ></div>
                        </header>

                        <div class="p-6 text-Dark overflow-auto">
                            <form
                                @submit.prevent="updateTema"
                                enctype="multipart/form-data"
                                class="m-6 space-y-6"
                            >
                                <div class="flex flex-col space-y-4">
                                    <InputLabel
                                        for="teks_tema"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Teks Tema
                                    </InputLabel>
                                    <TextInput
                                        v-model="form.teks_tema"
                                        type="text"
                                        name="teks_tema"
                                        id="teks_tema"
                                        class="block w-full p-2 border border-gray-300 rounded-md"
                                        required
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.teks_tema"
                                    />

                                    <InputLabel
                                        for="foto_tema"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Foto Tema
                                    </InputLabel>
                                    <input
                                        name="foto_tema"
                                        id="foto_tema"
                                        @change="handleFileUpload"
                                        type="file"
                                        class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Biru file:text-white hover:file:bg-Orange"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.foto_tema"
                                    />

                                    <img
                                        v-if="form.foto_preview"
                                        :src="form.foto_preview"
                                        alt="Theme Photo Preview"
                                        class="mt-4 h-64 w-64 object-cover mx-auto border-4 border-Dark"
                                    />
                                </div>

                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                >
                                    Update Tema
                                </button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { ref, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import { defineProps } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    tema: Object,
});

const form = useForm({
    teks_tema: props.tema.teks_tema,
    foto_tema: null,
    _method: "put",
    foto_preview: props.tema.foto_tema
        ? `/storage/${props.tema.foto_tema}`
        : null,
});

const handleFileUpload = (event) => {
    form.foto_tema = event.target.files[0];
    form.foto_preview = URL.createObjectURL(event.target.files[0]);
};

watch(
    () => form.foto_tema,
    (newVal) => {
        if (newVal) {
            form.foto_preview = form.foto_tema;
        }
    }
);
const updateTema = async () => {
    form.post(route("tema.update", props.tema.id), {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>
