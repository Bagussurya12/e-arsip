<template>
    <Head title="Tambah Data Pengadaan" />
    <AuthenticatedLayout class="w-full">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Tambah Data Pengadaan
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <section class="bg-white py-10">
                    <header class="m-6 space-y-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Tambah Data Pengadaan
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Tambah Data Pengadaan untuk menyimpan data pengadaan agar selalu konsisten ✨
                        </p>
                        <div class="w-full border-t border-slate-700 my-10"></div>
                    </header>

                    <form @submit.prevent="submitForm" enctype="multipart/form-data" class="m-6 space-y-6">
                        <!-- Title -->
                        <div class="mb-4 flex flex-col space-y-2 mt-5">
                            <InputLabel for="title" value="Judul Pengadaan" />
                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                placeholder="Masukkan judul pengadaan"
                            />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <!-- Tanggal, Bulan, Tahun -->
                        <div class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5">
                            <!-- Tanggal -->
                            <div class="w-full md:w-1/3 flex flex-col space-y-2 mt-5">
                                <InputLabel for="tanggal" value="Tanggal" />
                                <TextInput
                                    id="tanggal"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.tanggal"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukkan tanggal"
                                    min="1"
                                />
                                <InputError class="mt-2" :message="form.errors.tanggal" />
                            </div>

                            <!-- Bulan -->
                            <div class="w-full md:w-1/3 flex flex-col space-y-2 mt-5">
                                <InputLabel for="bulan" value="Bulan" />
                                <SelectBox
                                    v-model="form.bulan"
                                    :options="optionBulan"
                                    label="Pilih Bulan"
                                    id="bulan"
                                    name="bulan"
                                    placeholder="Pilih Bulan"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.bulan" />
                            </div>

                            <!-- Tahun -->
                            <div class="w-full md:w-1/3 flex flex-col space-y-2 mt-5">
                                <InputLabel for="tahun" value="Tahun" />
                                <TextInput
                                    id="tahun"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.tahun"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukkan tahun"
                                    min="1900"
                                />
                                <InputError class="mt-2" :message="form.errors.tahun" />
                            </div>
                        </div>

                        <!-- Division, Status, Procurement Number -->
                        <div class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5">
                            <!-- Division -->
                            <div class="w-full md:w-1/3 flex flex-col space-y-2 mt-5">
                                <InputLabel for="division" value="Divisi" />
                                <TextInput
                                    id="division"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.division"
                                    required
                                    placeholder="Masukkan divisi"
                                />
                                <InputError class="mt-2" :message="form.errors.division" />
                            </div>

                            <!-- Status -->
                            <div class="w-full md:w-1/3 flex flex-col space-y-2 mt-5">
                                <InputLabel for="status" value="Status" />
                                <SelectBox
                                    v-model="form.status"
                                    :options="optionStatus"
                                    label="Pilih Status"
                                    id="status"
                                    name="status"
                                    placeholder="Pilih Status"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.status" />
                            </div>

                            <!-- Procurement Number -->
                            <div class="w-full md:w-1/3 flex flex-col space-y-2 mt-5">
                                <InputLabel for="procurement_number" value="Nomor Pengadaan" />
                                <TextInput
                                    id="procurement_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.procurement_number"
                                    required
                                    placeholder="Masukkan nomor pengadaan"
                                />
                                <InputError class="mt-2" :message="form.errors.procurement_number" />
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="mb-4 flex flex-col space-y-2 mt-5">
                            <InputLabel for="remarks" value="Catatan" />
                            <textarea
                                id="remarks"
                                class="mt-1 block w-full rounded-lg border-gray-300"
                                v-model="form.remarks"
                                placeholder="Masukkan catatan"
                            />
                            <InputError class="mt-2" :message="form.errors.remarks" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-center gap-2 mt-10">
                            <PrimaryButton
                                :disabled="form.processing"
                                class="w-full justify-center"
                            >
                                Simpan Data
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
import SelectBox from "@/Components/SelectBox.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    tanggal: "",
    title: "",
    bulan: "",
    tahun: "",
    division: "",
    status: "",
    procurement_number: "",
    remarks: "",
});

const optionBulan = [
    { value: "Januari", label: "Januari" },
    { value: "Februari", label: "Februari" },
    { value: "Maret", label: "Maret" },
    { value: "April", label: "April" },
    { value: "Mei", label: "Mei" },
    { value: "Juni", label: "Juni" },
    { value: "Juli", label: "Juli" },
    { value: "Agustus", label: "Agustus" },
    { value: "September", label: "September" },
    { value: "Oktober", label: "Oktober" },
    { value: "November", label: "November" },
    { value: "Desember", label: "Desember" },
];

const optionStatus = [
    { value: "Pending", label: "Pending" },
    { value: "Proses", label: "Proses" },
    { value: "Selesai", label: "Selesai" },
];

const submitForm = () => {
    form.post(route("procurement.store"), {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
