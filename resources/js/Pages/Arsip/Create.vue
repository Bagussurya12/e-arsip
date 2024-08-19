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
                            <!-- JENIS SURAT -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="jenis_surat"
                                    value="Jenis surat"
                                />
                                <SelectBox
                                    v-model="form.jenis_surat"
                                    :options="optionJenisSurat"
                                    label="Pilih Jenis Surat"
                                    id="select-box"
                                    name="jenisSurat"
                                    placeholder="Pilih Jenis Surat"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.jenis_surat"
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
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan Asal Surat"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.no_bindeks"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- TANGGAL -->
                            <div
                                class="w-full md:w-1/3 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="tanggal" value="Tanggal" />
                                <TextInput
                                    id="tanggal"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.tanggal"
                                    required
                                    autocomplete="off"
                                    placeholder="Masukan tanggal"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tanggal"
                                />
                            </div>
                            <!--  BULAN -->
                            <div
                                class="w-full md:w-1/3 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="bulan" value="Bulan" />
                                <SelectBox
                                    v-model="form.bulan"
                                    :options="optionBulan"
                                    label="Pilih Map Bulan"
                                    id="select-box"
                                    name="selectBox"
                                    placeholder="Pilih Map Bulan"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.bulan"
                                />
                            </div>
                            <!-- TAHUN -->
                            <div
                                class="w-full md:w-1/3 flex flex-col space-y-2 mt-5"
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
                            <!-- URAIAN INFORMASI ARSIP -->
                            <div class="w-full flex flex-col space-y-2 mt-5">
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
                            <!-- TINGKAT PERKEMBANGAN -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel
                                    for="tingkat_perkembangan"
                                    value="Tingkat Perkembangan"
                                />
                                <SelectBox
                                    v-model="form.tingkat_perkembangan"
                                    :options="optionTingkatPerkembangan"
                                    label="Tingkat Perkembangan"
                                    id="select-box"
                                    name="selectBox"
                                    placeholder="Tingkat Perkembangan"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tingkat_perkembangan"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- Disposisi -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="disposisi" value="Disposisi" />
                                <TextInput
                                    id="diposisi"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.disposisi"
                                    autocomplete="off"
                                    placeholder="Masukan disposisi"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.disposisi"
                                />
                            </div>
                            <!-- Terusan  -->
                            <div
                                class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="terusan" value="Terusan" />
                                <SelectBox
                                    v-model="form.terusan"
                                    :options="optionTerusan"
                                    label="Terusan"
                                    id="select-box"
                                    name="selectBox"
                                    placeholder="Pilih Terusan"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.terusan"
                                />
                            </div>
                        </div>

                        <div
                            class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                        >
                            <!-- kolom_lemari -->
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
                                    autocomplete="off"
                                    placeholder="Masukan Kolom Lemari"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.kolom_lemari"
                                />
                            </div>

                            <!-- KOTAK -->
                            <div
                                class="w-full md:w-1/3 flex flex-col space-y-2 mt-5"
                            >
                                <InputLabel for="kotak" value="Kotak A/B" />
                                <SelectBox
                                    v-model="form.kotak"
                                    :options="optionKotak"
                                    label="Pilih Kotak"
                                    id="select-box"
                                    name="selectBox"
                                    placeholder="Pilih kotak"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.kotak"
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
                                    class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Biru file:text-white hover:file:bg-Orange"
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
                        <div
                            class="w-full border-t border-slate-700 my-10"
                        ></div>

                        <div v-if="form.jenis_surat === 'Surat Undangan'">
                            <div
                                class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                            >
                                <div
                                    class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                                >
                                    <InputLabel
                                        for="diposisi_acara"
                                        value="Disposisi Acara"
                                    />
                                    <TextInput
                                        id="diposisi_acara"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.disposisi_acara"
                                        autocomplete="on"
                                        placeholder="Masukan Disposisi Acara"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.disposisi_acara"
                                    />
                                </div>
                                <div
                                    class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                                >
                                    <InputLabel for="notulen" value="Notulen" />
                                    <TextInput
                                        id="notulen"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.notulen"
                                        autocomplete="on"
                                        placeholder="Masukan Notulen"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.notulen"
                                    />
                                </div>
                            </div>

                            <div
                                class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5"
                            >
                                <div
                                    class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                                >
                                    <InputLabel
                                        for="keterangan"
                                        value="Keterangan Undangan"
                                    />
                                    <TextInput
                                        id="keterangan_undangan"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.keterangan_undangan"
                                        autocomplete="on"
                                        placeholder="Masukan Keterangan Undangan"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="
                                            form.errors.keterangan_undangan
                                        "
                                    />
                                </div>
                                <div
                                    class="w-full md:w-1/2 flex flex-col space-y-2 mt-5"
                                >
                                    <InputLabel
                                        for="foto_kegiatan"
                                        value="Foto Kegiatan"
                                    />
                                    <input
                                        id="foto_kegiatan"
                                        type="file"
                                        class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Biru file:text-white hover:file:bg-Orange"
                                        @change="handleFileUploadUndangan"
                                        placeholder="Masukan File Foto Kegiatan"
                                        name="foto_kegiatan"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.foto_kegiatan"
                                    />
                                </div>
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
import { Head, useForm, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectBox from "@/Components/SelectBox.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { defineProps, computed, watch, reactive } from "vue";

const props = defineProps({
    terusan: Array,
});

// Debugging
// console.log("Props Terusan on Init:", props.terusan);

const form = useForm({
    keterangan: "",
    jenis_surat: "",
    asal_surat: "",
    tanggal: "",
    bulan: "",
    tahun: "",
    uraian_informasi: "",
    nomor_urut_perbulan: "",
    nomor_dokumen: "",
    kolom_lemari: "",
    kotak: "",
    jumlah: "",
    tingkat_perkembangan: "",
    disposisi: "",
    terusan: null,
    jenis_media: "",
    media: null,
    disposisi_acara: "",
    notulen: "",
    keterangan_undangan: "",
    foto_kegiatan: null,
});

const optionTerusan = computed(() => {
    if (props.terusan && Array.isArray(props.terusan)) {
        return props.terusan.map((item) => ({
            label: item.value,
            value: item.value,
        }));
    } else {
        return [];
    }
});

// Debugging
watch(optionTerusan, (newVal) => {
    console.log("Options Terusan:", newVal);
});
const optionJenisSurat = [
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
    { value: "Surat Permohonan", label: "Surat Permohonan" },
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

const optionTingkatPerkembangan = [
    { value: "Copy", label: "Copy" },
    { value: "Asli", label: "Asli" },
];

const optionKeterangan = [
    { value: "Surat Masuk", label: "Surat Masuk" },
    { value: "Surat Keluar", label: "Surat Keluar" },
];

const optionKotak = [
    { value: "A", label: "A" },
    { value: "B", label: "B" },
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
const handleFileUploadUndangan = (event) => {
    form.foto_kegiatan = event.target.files[0];
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
            // Reset form setelah sukses menyimpan data
            form.reset();
        },
    });
};
</script>
