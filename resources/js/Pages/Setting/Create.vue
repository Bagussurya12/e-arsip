<template>
    <Head title="Tambah Tema" />

    <AuthenticatedLayout class="w-full">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Tambah Tema
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <section>
                    <header class="m-6 space-y-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Tambah Tema
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
                                <InputLabel for="teks" value="Teks Tema" />
                                <TextInput
                                    id="teks_tema"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.teks_tema"
                                    autocomplete="on"
                                    placeholder="Masukan Teks Tema"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.teks_tema"
                                />
                            </div>
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="foto_tema" value="Foto Tema" />
                                <input
                                    id="foto_tema"
                                    type="file"
                                    class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Biru file:text-white hover:file:bg-Orange"
                                    @change="handleFileUpload"
                                    placeholder="Masukan File Foto Tema"
                                    name="foto_tema"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.foto_tema"
                                />
                            </div>
                        </div>
                        <div
                            class="flex items-center text-center justify-center gap-2 mt-10"
                        >
                            <PrimaryButton
                                :disabled="form.processing"
                                class="w-full justify-center mt-10"
                                >Simpan Data</PrimaryButton
                            >
                            <Transition
                                enter-from-class="opacity-0"
                                leave-to-class="opacity-0"
                                class="transition ease-in-out"
                            >
                                <p
                                    v-if="form.recentlySuccessful"
                                    class="text-sm text-gray-600"
                                >
                                    Data Berhasil Disimpan!
                                </p>
                            </Transition>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    teks_tema: "",
    foto_tema: null,
});
const handleFileUpload = (event) => {
    form.foto_tema = event.target.files[0];
};

const submitForm = () => {
    const formData = new FormData();
    Object.keys(form).forEach((key) => {
        formData.append(key, form[key]);
    });

    if (form.foto_keterangan) {
        formData.append("foto_keterangan", form.foto_keterangan);
    }

    form.post(route("tema.store"), {
        data: formData,
        forceFormData: true,
        onSuccess: () => {
            // Reset form setelah sukses menyimpan data
            form.reset();
        },
    });
};
</script>
