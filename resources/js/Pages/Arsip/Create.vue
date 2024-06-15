<template>
    <Head title="Tambah Data Arsip" />

    <AuthenticatedLayout class="w-full">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Tambah Data Arsip
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <section>
                    <header class="m-6 space-y-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Tambah Data Arsip
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Tambah Data Arsip Untuk Menyimpan Data Arsip Agar
                            Selalu Konsisten ✨
                        </p>
                        <div
                            class="w-full border-t border-slate-700 my-10"
                        ></div>
                    </header>
                    <form action="" class="m-6 space-y-6">
                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="jenis_arsip"
                                    value="Jenis Arsip"
                                />
                                <SelectBox
                                    v-model="form.jenis_arsip"
                                    :options="optionNaskahDinas"
                                    label="Pilih Naskah Dinas"
                                    id="select-box"
                                    name="selectBox"
                                    placeholder="Pilih Naskah Dinas"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.jenis_arsip"
                                />
                            </div>
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="kolom_lemari"
                                    value="Kolom Lemari"
                                />
                                <TextInput
                                    id="kolom_lemari"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.kolom_lemari"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Kolom Lemari"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.kolom_lemari"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- NOMOR BINDEKS -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="no_bindeks"
                                    value="Nomor Bindeks"
                                />
                                <TextInput
                                    id="no_bindeks"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.no_bindeks"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Nomor Bindeks"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.no_bindeks"
                                />
                            </div>
                            <!-- MAP BULAN -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="map_bulan" value="Map Bulan" />
                                <SelectBox
                                    v-model="form.map_bulan"
                                    :options="optionBulan"
                                    label="Pilih Map Bulan"
                                    id="select-box"
                                    name="selectBox"
                                    placeholder="Pilih Map Bulan"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.map_bulan"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- NOMOR URUT PERBULAN -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="no_urut_perbulan"
                                    value="Nomor Urut Perbulan"
                                />
                                <TextInput
                                    id="no_urut_perbulan"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.no_urut_perbulan"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Nomor Urut Perbulan"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.no_urut_perbulan"
                                />
                            </div>
                            <!-- NOMOR DOKUMEN -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="no_dokumen"
                                    value="Nomor Dokumen"
                                />
                                <TextInput
                                    id="no_dokumen"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.no_dokumen"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Nomor Dokumen"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.no_dokumen"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- URAIAN INFORMASI ARSIP -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="uraian_informasi"
                                    value="Uraian Informasi Arsip"
                                />
                                <textarea
                                    name=""
                                    id="uraianInformasi"
                                    type="text"
                                    class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-Dark focus:border-Dark"
                                    v-model="form.uraian_informasi"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Uraian Informasi"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.uraian_informasi"
                                />
                            </div>

                            <!-- ASAL SURAT -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="asal_surat"
                                    value="Asal Surat"
                                />
                                <TextInput
                                    id="no_bindeks"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.asal_surat"
                                    autocomplete="off"
                                    placeholder="Masukan Asal Surat"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.asal_surat"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- TANGGAL SURAT -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="tanggal_surat"
                                    value="Tanggal Surat"
                                />
                                <TextInput
                                    name=""
                                    id="tanggal_surat"
                                    type="date"
                                    class="mt-1 block w-full rounded-lg"
                                    v-model="form.tanggal_surat"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Tanggal Surat"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tanggal_surat"
                                />
                            </div>

                            <!-- Jumlah Berkas -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="jumlah_berkas"
                                    value="Jumlah Berkas/Lembar"
                                />
                                <TextInput
                                    id="no_bindeks"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.jumlah_berkas"
                                    autocomplete="off"
                                    placeholder="Masukan Jumlah Berkas/Lembar"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.jumlah_berkas"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- TINGKAT PERKEMBANGAN -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="tingkat_perkembangan"
                                    value="Tingkat Perkembangan"
                                />
                                <TextInput
                                    name=""
                                    id="tingkat_perkembangan"
                                    type="text"
                                    class="mt-1 block w-full rounded-lg"
                                    v-model="form.tingkat_perkembangan"
                                    autocomplete="off"
                                    placeholder="Masukan Tingkat Perkembangan"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tingkat_perkembangan"
                                />
                            </div>

                            <!-- KETERANGAN -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="keterangan"
                                    value="Keterangan"
                                />
                                <SelectBox
                                    v-model="form.keterangan"
                                    :options="optionKeterangan"
                                    label="Pilih Keterangan"
                                    id="select-box"
                                    name="selectBox"
                                    placeholder="Pilih Keterangan"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.keterangan"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- JENIS MEDIA -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="jenis_media"
                                    value="Jenis Media"
                                />
                                <SelectBox
                                    v-model="form.jenis_media"
                                    :options="optionJenisMedia"
                                    label="Pilih Jenis Media"
                                    id="select-box"
                                    name="selectBox"
                                    placeholder="Pilih Jenis Media"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.jenis_media"
                                />
                            </div>

                            <!-- NAMA MEDIA -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="nama_media"
                                    value="File Media"
                                />
                                <input
                                    name=""
                                    id="nama_media"
                                    type="file"
                                    class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Dark file:text-white hover:file:bg-Dark"
                                    autocomplete="off"
                                    placeholder="Masukan File Media"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.nama_media"
                                />
                            </div>
                        </div>
                        <div class="flex justify-center mt-20">
                            <button
                                type="submit"
                                :disabled="isSubmitting"
                                class="bg-Dark text-white px-4 py-2 rounded-md shadow-md hover:bg-amber-800 focus:outline-none focus:ring-2 w-1/2"
                            >
                                <span v-if="!isSubmitting"
                                    >Simpan Data Arsip</span
                                >
                                <svg
                                    v-else
                                    class="animate-spin h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8v8H4z"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectBox from "@/Components/SelectBox.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    jenis_arsip: "",
    kolom_lemari: null,
    no_bindeks: null,
    map_bulan: "",
    no_urut_perbulan: null,
    no_dokumen: "",
    uraian_informasi: "",
    asal_surat: "",
    tanggal_surat: "",
    jumlah_berkas: null,
    tingkat_perkembangan: "",
    keterangan: "",
    nama_media: "",
    jenis_media: "",
});

const optionNaskahDinas = [
    { value: "Instruksi", label: "Instruksi" },
    { value: "Surat Perintah", label: "Surat Perintah" },
    { value: "Surat Keterangan", label: "Surat Keterangan" },
    { value: "Surat Biasa", label: "Surat Biasa" },
    { value: "Surat Tugas", label: "Surat Tugas" },
    { value: "Surat Kuasa", label: "Surat Kuasa" },
    { value: "Surat Undangan", label: "Surat Undangan" },
    { value: "Surat Edaran", label: "Surat Edaran" },
    { value: "Surat Keputusan", label: "Surat Keputusan" },
    { value: "Surat Perjanjian", label: "Surat Perjanjian" },
    { value: "Surat Laporan", label: "Surat Laporan" },
    { value: "Nota Dinas", label: "Nota Dinas" },
    {
        value: "Nota Pengajuan Naskah Dinas",
        label: "Nota Pengajuan Naskah Dinas",
    },
    { value: "Telaahan Staf", label: "Telaahan Staf" },
    { value: "Lain-lain", label: "Lain-lain" },
];

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

const optionKeterangan = [
    { value: "Surat Masuk", label: "Surat Masuk" },
    { value: "Surat Keluar", label: "Surat Keluar" },
];

const optionJenisMedia = [
    { value: "PDF", label: "PDF" },
    { value: "Gambar", label: "Gambar" },
    { value: "Audio", label: "Audio" },
    { value: "Vidio", label: "Vidio" },
];
</script>
