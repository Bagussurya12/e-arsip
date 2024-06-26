<template>
    <Head title="Edit Data Arsip" />

    <AuthenticatedLayout class="w-full">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Edit Data Arsip
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <section>
                    <header class="m-6 space-y-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Edit Data Arsip
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Edit Data Arsip Untuk Memperbarui Data Arsip Agar
                            Selalu Konsisten ✨
                        </p>
                        <div
                            class="w-full border-t border-slate-700 my-10"
                        ></div>
                    </header>
                    <form
                        @submit.prevent="updateArsip"
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
                            <!-- TAHUN -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="tahun" value="Tahun" />
                                <TextInput
                                    id="tahun"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.tahun"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Tahun"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tahun"
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
                                    id="asal_surat"
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
                                    id="jumlah_berkas"
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
                                    class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Dark file:text-white hover:file:bg-Dark"
                                    type="file"
                                    @change="handleFileUpload"
                                    :accepted-mime-types="[
                                        'image/jpeg',
                                        'image/png',
                                        'application/pdf',
                                        'audio/mp3',
                                        'video/mp4',
                                    ]"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.media"
                                />
                                <!-- Tampilkan nama file lama jika ada -->
                                <div v-if="form.old_media">
                                    <p class="mt-2 text-sm text-gray-600">
                                        File Lama: {{ form.old_media }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
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
import { Inertia } from "@inertiajs/inertia";
import { ref, watch } from "vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectBox from "@/Components/SelectBox.vue";

const props = defineProps({
    arsip: Object,
});

// Initialize form using `useForm` with initial values.
const form = useForm({
    jenis_arsip: props.arsip.jenis_arsip,
    kolom_lemari: props.arsip.lokasi_simpan.kolom_lemari ?? "",
    no_bindeks: props.arsip.lokasi_simpan.no_bindeks ?? "",
    map_bulan: props.arsip.lokasi_simpan.map_bulan ?? "",
    tahun: props.arsip.lokasi_simpan.tahun ?? "",
    nomor_urut_perbulan: props.arsip.nomor_urut_perbulan ?? "",
    nomor_dokumen: props.arsip.nomor_dokumen ?? "",
    uraian_informasi: props.arsip.uraian_informasi ?? "",
    asal_surat: props.arsip.asal_surat ?? "",
    tanggal_surat: props.arsip.tanggal_surat ?? "",
    jumlah: props.arsip.jumlah ?? "",
    tingkat_perkembangan: props.arsip.tingkat_perkembangan ?? "",
    keterangan: props.arsip.keterangan ?? "",
    jenis_media: props.arsip.jenis_media ?? "",
    media: null,
    old_media: props.arsip.media, // Store the old media file name.
    _method: "put",
});

const handleFileUpload = (event) => {
    form.media = event.target.files[0];
};

watch(
    () => form.media,
    (newVal) => {
        if (newVal) {
            form.old_media = null;
        }
    }
);
const updateArsip = () => {
    form.post(route("arsip.update", props.arsip.id), {
        preserveState: true,
        preserveScroll: true,
    });
};
const optionNaskahDinas = [
    { value: "Peraturan Daerah", label: "Peraturan Daerah" },
    { value: "Peraturan Gubernur", label: "Peraturan Gubernur" },
    {
        value: "Peraturan Bersama Kepala Daerah",
        label: "Peraturan Bersama Kepala Daerah",
    },
    { value: "Keputusan Gubernur", label: "Keputusan Gubernur" },
    {
        value: "Keputusan Kepala Perangkat Daerah",
        label: "Keputusan Kepala Perangkat Daerah",
    },
    { value: "Instruksi", label: "Instruksi" },
    { value: "Surat Edaran", label: "Surat Edaran" },
    { value: "Seruan", label: "Seruan" },
    { value: "Surat Perintah", label: "Surat Perintah" },
    { value: "Surat Tugas", label: "Surat Tugas" },
    { value: "Nota Dinas", label: "Nota Dinas" },
    { value: "Nota Kesepakatan", label: "Nota Kesepakatan" },
    { value: "Kesepakatan Bersama", label: "Kesepakatan Bersama" },
    { value: "Surat Undangan", label: "Surat Undangan" },
    { value: "Surat Biasa", label: "Surat Biasa" },
    { value: "Surat Panggilan", label: "Surat Panggilan" },
    { value: "Telaahan Staf", label: "Telaahan Staf" },
    { value: "Laporan", label: "Laporan" },
    { value: "Perjanjian Kerja Sama", label: "Perjanjian Kerja Sama" },
    { value: "Surat Keterangan", label: "Surat Keterangan" },
    { value: "Surat Kuasa", label: "Surat Kuasa" },
    { value: "Berita Acara", label: "Berita Acara" },
    { value: "Pengumuman", label: "Pengumuman" },
    { value: "Surat Pengantar", label: "Surat Pengantar" },
    { value: "Surat Perjalanan Dinas", label: "Surat Perjalanan Dinas" },
    { value: "Notulen Rapat", label: "Notulen Rapat" },
    { value: "Notulen Rapat Hasil Rapat", label: "Notulen Rapat Hasil Rapat" },
    { value: "Sertifikat", label: "Sertifikat" },
    { value: "Piagam", label: "Piagam" },
    {
        value: "Surat Tanda Tamat Pendidikan dan Pelatihan (STTPP)",
        label: "Surat Tanda Tamat Pendidikan dan Pelatihan (STTPP)",
    },
    { value: "Memo", label: "Memo" },
    {
        value: "Surat Keterangan Melaksanakan Tugas",
        label: "Surat Keterangan Melaksanakan Tugas",
    },
    { value: "Rekomendasi", label: "Rekomendasi" },
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

<style scoped>
/* Tambahkan gaya kustom di sini */
</style>
