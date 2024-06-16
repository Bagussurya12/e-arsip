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
import { ref } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectBox from "@/Components/SelectBox.vue";

const props = defineProps([
    "arsip",
    "optionNaskahDinas",
    "optionBulan",
    "optionKeterangan",
    "optionJenisMedia",
]);

const form = useForm({
    jenis_arsip: props.arsip.jenis_arsip ?? "",
    kolom_lemari: props.arsip.kolom_lemari ?? "",
    no_bindeks: props.arsip.no_bindeks ?? "",
    map_bulan: props.arsip.map_bulan ?? "",
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
});

const handleFileUpload = (event) => {
    form.media = event.target.files[0];
};

const updateArsip = () => {
    const formData = new FormData();
    formData.append("jenis_arsip", form.jenis_arsip);
    formData.append("kolom_lemari", form.kolom_lemari);
    formData.append("no_bindeks", form.no_bindeks);
    formData.append("map_bulan", form.map_bulan);
    formData.append("nomor_urut_perbulan", form.nomor_urut_perbulan);
    formData.append("nomor_dokumen", form.nomor_dokumen);
    formData.append("uraian_informasi", form.uraian_informasi);
    formData.append("asal_surat", form.asal_surat);
    formData.append("tanggal_surat", form.tanggal_surat);
    formData.append("jumlah", form.jumlah);
    formData.append("tingkat_perkembangan", form.tingkat_perkembangan);
    formData.append("keterangan", form.keterangan);
    formData.append("jenis_media", form.jenis_media);
    if (form.media) {
        formData.append("media", form.media);
    }

    Inertia.post(route("arsip.update", { id: props.arsip.id }), formData, {
        forceFormData: true,
        onFinish: () => {
            Inertia.visit(route("arsip"));
        },
    });
};
</script>

<style scoped>
/* Tambahkan gaya kustom di sini */
</style>
