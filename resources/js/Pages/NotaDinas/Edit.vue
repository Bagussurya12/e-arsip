<template>
    <Head title="Edit Nota Dinas" />
    <AuthenticatedLayout class="w-full">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Edit Nota Dinas
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <section class="bg-white py-10">
                    <header class="m-6 space-y-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Edit Data Nota Dinas
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Edit Data Nota Dinas Untuk Memperbarui Data yang Ada
                            ✨
                        </p>
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
                            <!-- TANGGAL -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="tanggal" value="Tanggal" />
                                <TextInput
                                    id="tanggal"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.tanggal"
                                    required
                                    autocomplete="off"
                                    placeholder="dd-mm-yyyy"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tanggal"
                                />
                            </div>

                            <!-- Perihal -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="perihal" value="Perihal" />
                                <TextInput
                                    id="perihal"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.perihal"
                                    autocomplete="off"
                                    placeholder="Masukkan perihal"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.perihal"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- Kepada -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="kepada" value="Kepada" />
                                <TextInput
                                    id="kepada"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.kepada"
                                    autocomplete="off"
                                    placeholder="Masukkan kepada"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.kepada"
                                />
                            </div>

                            <!-- Dari -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="dari" value="Dari" />
                                <TextInput
                                    id="dari"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.dari"
                                    autocomplete="off"
                                    placeholder="Masukkan dari"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.dari"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- Isi -->
                            <div class="w-full flex flex-col space-y-2 mt-5">
                                <InputLabel for="isi" value="Isi" />
                                <textarea
                                    id="isi"
                                    type="text"
                                    class="mt-1 block w-full rounded-lg border-gray-300"
                                    v-model="form.isi"
                                    autocomplete="off"
                                    placeholder="Masukkan isi"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.isi"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- Tembusan -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="tembusan" value="Tembusan" />
                                <TextInput
                                    id="tembusan"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.tembusan"
                                    autocomplete="off"
                                    placeholder="Masukkan tembusan"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tembusan"
                                />
                            </div>

                            <!-- Foto -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="foto" value="Foto" />
                                <input
                                    id="foto"
                                    type="file"
                                    class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Biru file:text-white hover:file:bg-Orange"
                                    @change="handleFileUpload"
                                    placeholder="Masukkan File Media"
                                    name="foto"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.foto"
                                />
                            </div>
                        </div>

                        <!-- Button -->
                        <div
                            class="flex items-center text-center justify-center gap-2 mt-10"
                        >
                            <PrimaryButton
                                :disabled="form.processing"
                                class="w-full justify-center mt-10"
                            >
                                Simpan Data
                            </PrimaryButton>
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
import { Head, useForm, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Inertia } from "@inertiajs/inertia";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { defineProps } from "vue";
import { format, parseISO } from "date-fns";

const props = defineProps({
    nota_dinas: Object,
});

const form = useForm({
    tanggal: format(parseISO(props.nota_dinas.tanggal), "yyyy-MM-dd"),
    perihal: props.nota_dinas.perihal || "",
    kepada: props.nota_dinas.kepada || "",
    dari: props.nota_dinas.dari || "",
    isi: props.nota_dinas.isi || "",
    tembusan: props.nota_dinas.tembusan || "",
    foto: null,
    old_foto: props.nota_dinas.foto || "",
    _method: "put",
});

const handleFileUpload = (event) => {
    form.foto = event.target.files[0];
};

const submitForm = () => {
    const formData = new FormData();
    formData.append("arsip_id", props.nota_dinas.arsip_id);
    formData.append("nomor_dokumen", props.nota_dinas.nomor_dokumen);

    Object.keys(form).forEach((key) => {
        formData.append(key, form[key]);
    });

    // Debugging log
    for (const [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
    }

    form.put(route("nota-dinas.update", props.nota_dinas.id), {
        data: formData,
        forceFormData: true,
        headers: {
            "X-HTTP-Method-Override": "PUT",
        },
        onSuccess: () => {
            Inertia.visit(route("arsip"));
        },
        onError: (errors) => {
            console.log("Form submission errors:", errors);
        },
    });
};
</script>
