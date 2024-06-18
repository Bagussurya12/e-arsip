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
                                    v-model="form.nomor_urut_perbulan"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Nomor Urut Perbulan"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.nomor_urut_perbulan"
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
                                    v-model="form.nomor_dokumen"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Nomor Dokumen"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.nomor_dokumen"
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
                                    v-model="form.jumlah"
                                    autocomplete="off"
                                    placeholder="Masukan Jumlah Berkas/Lembar"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.jumlah"
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
                                <InputLabel for="media" value="Media" />
                                <input
                                    id="media"
                                    type="file"
                                    class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Dark file:text-white hover:file:bg-Dark"
                                    @input="handleFileUpload"
                                    placeholder="Masukan File Media"
                                    name="media"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.media"
                                />
                            </div>
                        </div>
                        <div class="flex items-center text-center gap-2">
                            <PrimaryButton :disabled="form.processing"
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
import SelectBox from "@/Components/SelectBox.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    jenis_arsip: "",
    nomor_urut_perbulan: "",
    kolom_lemari: null,
    no_bindeks: null,
    map_bulan: "",
    nomor_dokumen: "",
    uraian_informasi: "",
    asal_surat: "",
    tanggal_surat: "",
    jumlah: null,
    tingkat_perkembangan: "",
    keterangan: "",
    jenis_media: "",
    media: null,
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

const handleFileUpload = (event) => {
    form.media = event.target.files[0];
};

const submitForm = () => {
    const formData = new FormData();
    Object.keys(form).forEach((key) => {
        formData.append(key, form[key]);
    });

    if (form.media) {
        formData.append("media", form.media);
    }

    form.post(route("arsip.store"), {
        data: formData,
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            console.log("Sukses"); // Reset form setelah sukses menyimpan data
        },
    });
};
</script>
