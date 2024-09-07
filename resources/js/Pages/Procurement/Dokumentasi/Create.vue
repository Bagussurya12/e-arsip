<template>
    <Head title="Tambah Dokumentasi" />
    <AuthenticatedLayout class="w-full">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Tambah Dokumentasi
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <section class="bg-white py-10">
                    <header class="m-6 space-y-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Tambah Dokumentasi Baru
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Tambah dokumentasi untuk mencatat setiap proses dengan baik ✨
                        </p>
                        <div class="w-full border-t border-slate-700 my-10"></div>
                    </header>

                    <form @submit.prevent="submitForm" enctype="multipart/form-data" class="m-6 space-y-6">
                        <!-- Title -->
                        <div class="mb-4 flex flex-col space-y-2 mt-5">
                            <InputLabel for="title" value="Judul Dokumentasi" />
                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                placeholder="Masukkan judul dokumentasi"
                            />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-4 flex flex-col space-y-2 mt-5">
                            <InputLabel for="tanggal" value="Tanggal" />
                            <TextInput
                                id="tanggal"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.tanggal"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.tanggal" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4 flex flex-col space-y-2 mt-5">
                            <InputLabel for="deskripsi" value="Deskripsi" />
                            <textarea
                                id="deskripsi"
                                class="mt-1 block w-full rounded-lg border-gray-300"
                                v-model="form.deskripsi"
                                placeholder="Masukkan deskripsi"
                            />
                            <InputError class="mt-2" :message="form.errors.deskripsi" />
                        </div>

                        <!-- Foto Kegiatan -->
                        <div class="mb-4 flex flex-col space-y-2 mt-5">
                            <InputLabel for="foto" value="Foto Kegiatan" />
                            <input
                                id="foto"
                                type="file"
                                class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Biru file:text-white hover:file:bg-Orange"
                                @change="handleFileUpload"
                                name="foto"
                            />
                            <InputError class="mt-2" :message="form.errors.foto" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-center gap-2 mt-10">
                            <PrimaryButton
                                :disabled="form.processing"
                                class="w-full justify-center"
                            >
                                Simpan Dokumentasi
                            </PrimaryButton>
                            <Transition
                                enter-from-class="opacity-0"
                                leave-to-class="opacity-0"
                                class="transition ease-in-out"
                            >
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
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
import { ref } from "vue";

const props = defineProps({
    procurement_id: {
        type: Number,
        required: true,
    },
});
const form = useForm({
    procurement_id: props.procurement_id,
    title: "",
    tanggal:"",
    deskripsi:"",
    foto: null,
});

const handleFileUpload = (event) => {
    form.foto = event.target.files[0];
};

const submitForm = () => {
    form.post(route("procurement.dokumentasi.store"), {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
        },
    });
};

</script>
