<template>
    <Head title="Detail Surat Undangan" />
    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Detail Arsip
            </h3>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row">
                    <!-- DOKUMEN VIEW -->
                    <div class="w-full md:w-1/2 self-center px-4 mb-4 md:mb-0">
                        <iframe
                            :src="`/storage/${arsip.media}`"
                            width="100%"
                            height="600px"
                            style="border: none"
                            class="w-full h-[800px] border-none rounded-md"
                        ></iframe>
                    </div>
                    <!-- KETERANGAN DOKUMEN -->
                    <div class="w-full md:w-1/2 self-start px-4 mt-10">
                        <div class="flex mb-4">
                            <strong class="w-1/3">Naskah Dinas</strong>
                            <span class="w-2/3">: {{ arsip.jenis_surat }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Asal Surat</strong>
                            <span class="w-2/3">: {{ arsip.asal_surat }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Nomor Dokumen</strong>
                            <span class="w-2/3"
                                >: {{ arsip.nomor_dokumen }}</span
                            >
                        </div>

                        <div class="flex mb-4">
                            <strong class="w-1/3">Tanggal Surat</strong>
                            <span class="w-2/3"
                                >: {{ arsip.tanggal }}/{{ arsip.bulan }}/{{
                                    arsip.tahun
                                }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Uraian Informasi</strong>
                            <span class="w-2/3"
                                >: {{ arsip.uraian_informasi }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Keterangan</strong>
                            <span class="w-2/3">: {{ arsip.keterangan }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Tingkat Perkembangan</strong>
                            <span class="w-2/3"
                                >: {{ arsip.tingkat_perkembangan }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Jenis Media</strong>
                            <span class="w-2/3">: {{ arsip.jenis_media }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Disposisi</strong>
                            <span class="w-2/3"
                                >:
                                {{
                                    arsip.disposisi ? arsip.disposisi : "-"
                                }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Terusan</strong>
                            <span class="w-2/3"
                                >:
                                {{ arsip.terusan ? arsip.terusan : "-" }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Kolom Lemari</strong>
                            <span class="w-2/3"
                                >: {{ arsip.lokasi_simpan.kolom_lemari }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Kotak</strong>
                            <span class="w-2/3"
                                >: {{ arsip.lokasi_simpan.kotak }}</span
                            >
                        </div>
                        <div class="flex mt-20">
                            <a
                                :href="`/storage/${arsip.media}`"
                                target="_blank"
                                class="bg-Dark text-white font-bold py-2 px-4 rounded mr-4 hover:bg-Hijau"
                            >
                                Lihat Dokumen
                            </a>
                            <a
                                :href="`/storage/${arsip.media}`"
                                download
                                class="bg-Hijau text-white font-bold py-2 px-4 rounded hover:bg-Dark"
                            >
                                Unduh Dokumen
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    v-if="arsip.jenis_surat === 'Surat Undangan'"
                    class="mb-10"
                >
                    <div class="items-center m-20 text-center">
                        <div class="w-full border-t border-slate-700 my-10" />
                        <h1 class="text-2xl font-bold text-Biru">
                            Dokumentasi Kegiatan Acara Undangan
                        </h1>
                    </div>
                    <div class="flex flex-col md:flex-row">
                        <div
                            class="w-full md:w-1/2 self-center px-4 mb-4 md:mb-0"
                        >
                            <iframe
                                :src="`/storage/${arsip.undangan.foto_kegiatan}`"
                                width="100%"
                                height="600px"
                                style="border: none"
                                class="w-full h-[600px] border-none rounded-md"
                            ></iframe>
                        </div>

                        <!-- K -->
                        <div class="w-full md:w-1/2 self-start px-4">
                            <div class="flex mb-4">
                                <strong class="w-1/3"
                                    >Disposisi Kegiatan</strong
                                >
                                <span class="w-2/3"
                                    >:
                                    {{
                                        arsip.undangan.disposisi_acara
                                            ? arsip.undangan.disposisi_acara
                                            : "-"
                                    }}</span
                                >
                            </div>
                            <div class="flex mb-4">
                                <strong class="w-1/3"
                                    >Keterangan Kegiatan</strong
                                >
                                <span class="w-2/3"
                                    >:
                                    {{
                                        arsip.undangan.disposisi_acara
                                            ? arsip.undangan.disposisi_acara
                                            : "-"
                                    }}</span
                                >
                            </div>
                            <div class="flex mb-4">
                                <strong class="w-1/3">Notulen</strong>
                                <span class="w-2/3"
                                    >:
                                    {{
                                        arsip.undangan.notulen
                                            ? arsip.undangan.notulen
                                            : "-"
                                    }}</span
                                >
                            </div>

                            <div class="flex mt-20">
                                <a
                                    :href="`/storage/${arsip.undangan.foto_kegiatan}`"
                                    target="_blank"
                                    class="bg-Dark text-white font-bold py-2 px-4 rounded mr-4 hover:bg-Hijau"
                                >
                                    Lihat Foto
                                </a>
                                <a
                                    :href="`/storage/${arsip.undangan.foto_kegiatan}`"
                                    download
                                    class="bg-Hijau text-white font-bold py-2 px-4 rounded hover:bg-Dark"
                                >
                                    Unduh Foto
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    arsip: Object,
});
</script>
