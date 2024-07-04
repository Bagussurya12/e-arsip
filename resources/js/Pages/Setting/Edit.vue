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
                                @submit.prevent="submitForm"
                                enctype="multipart/form-data"
                                class="space-y-6"
                            >
                                <div class="flex flex-col space-y-4">
                                    <label
                                        for="teks_tema"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Teks Tema
                                    </label>
                                    <input
                                        v-model="form.teks_tema"
                                        type="text"
                                        name="teks_tema"
                                        id="teks_tema"
                                        class="block w-full p-2 border border-gray-300 rounded-md"
                                        required
                                    />

                                    <label
                                        for="foto_tema"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Foto Tema
                                    </label>
                                    <input
                                        @change="handleFileUpload"
                                        type="file"
                                        name="foto_tema"
                                        id="foto_tema"
                                        class="block w-full p-2 border border-gray-300 rounded-md"
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
import { useForm } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps({
    tema: Object,
});

const form = useForm({
    teks_tema: props.tema.teks_tema ?? "",
    foto_preview: props.tema.foto_tema
        ? `/storage/${props.tema.foto_tema}`
        : null,
});

const submitForm = async () => {
    const formData = new FormData();
    formData.append("teks_tema", form.teks_tema);
    if (form.foto_tema) {
        formData.append("foto_tema", form.foto_tema);
    }
    formData.append("_method", "PUT"); // Add _method: PUT

    try {
        await form.put(route("tema.update", props.tema.id), formData);
        console.log("Tema berhasil diperbarui");
    } catch (error) {
        console.error("Gagal memperbarui tema:", error);
    }
};
</script>
