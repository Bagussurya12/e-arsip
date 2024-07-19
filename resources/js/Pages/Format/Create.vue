<template>
    <Head title="Tambah Format Surat" />

    <AuthenticatedLayout class="w-full">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Tambah Format Surat
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <section>
                    <header class="m-6 space-y-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Tambah Format Surat
                        </h2>

                        <div
                            class="w-full border-t border-slate-700 my-10"
                        ></div>
                    </header>

                    <form
                        @submit.prevent="submitForm"
                        enctype="multipart/form-data"
                        class="m-6 space-y-6"
                    >
                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="title"
                                    value="Nama Format Surat"
                                />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.title"
                                    autocomplete="on"
                                    placeholder="Masukan Nama Format Surat"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.title"
                                />
                            </div>
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="file_surat"
                                    value="Format Surat"
                                />
                                <input
                                    id="file_surat"
                                    type="file"
                                    class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Biru file:text-white hover:file:bg-Orange"
                                    @change="handleFileUpload"
                                    placeholder="Masukan File Format Surat"
                                    name="file_surat"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.file_surat"
                                />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-10">
                            <Link
                                :href="route('format.index')"
                                class="bg-Biru text-white font-bold py-2 px-4 rounded mr-4"
                            >
                                Batal
                            </Link>
                            <button
                                type="submit"
                                class="bg-Orange hover:bg-Orange-dark text-white font-bold py-2 px-4 rounded"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, useForm, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    title: "",
    file_surat: null,
});
const handleFileUpload = (event) => {
    form.file_surat = event.target.files[0];
};

const submitForm = () => {
    const formData = new FormData();
    Object.keys(form).forEach((key) => {
        formData.append(key, form[key]);
    });

    if (form.file_surat) {
        formData.append("file_surat", form.file_surat);
    }

    form.post(route("format.store"), {
        data: formData,
        forceFormData: true,
        onSuccess: () => {
            // Reset form setelah sukses menyimpan data
            form.reset();
        },
    });
};
</script>
