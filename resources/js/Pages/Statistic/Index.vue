<template>
    <AuthenticatedLayout>
        <Head title="Statistik" />

        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Statistik Arsip
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <BarChartKeterangan
                        :totalSuratMasuk="totalSuratMasuk"
                        :totalSuratKeluar="totalSuratKeluar"
                        :jenisSurat="jenisSurat"
                    />
                </div>
            </div>

            <!-- DATA ARSIP -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-2 mt-10 mb-20">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-Dark">
                        <h1 class="font-bold text-xl mb-16 text-center">
                            Data Arsip
                        </h1>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="mb-5">
                                    <tr class="border-b-2">
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            No
                                        </th>
                                        <th
                                            class="px-8 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Keterangan
                                        </th>
                                        <th
                                            class="px-16 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Jenis Surat
                                        </th>
                                        <th
                                            class="px-18 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Asal Surat
                                        </th>
                                        <th
                                            class="px-32 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Uraian Informasi
                                        </th>
                                        <th
                                            class="px-18 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Tanggal Surat
                                        </th>
                                    </tr>
                                </thead>
                                <!-- Body Table -->
                                <tbody>
                                    <tr
                                        v-for="(arsip, index) in dataArsip.data"
                                        :key="arsip.id"
                                    >
                                        <td class="px-6 py-4 text-center">
                                            {{
                                                index +
                                                1 +
                                                (dataArsip.current_page - 1) *
                                                    dataArsip.per_page
                                            }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsip.keterangan }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsip.jenis_surat }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsip.asal_surat }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsip.uraian_informasi }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsip.tanggal }}/{{
                                                arsip.bulan
                                            }}/{{ arsip.tahun }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-10">
                            <button
                                @click="prevPage"
                                :disabled="!dataArsip.prev_page_url"
                                class="px-4 py-2 mr-2 bg-Orange text-white rounded hover:bg-Biru"
                            >
                                Sebelumnya
                            </button>
                            <button
                                @click="nextPage"
                                :disabled="!dataArsip.next_page_url"
                                class="px-4 py-2 bg-Orange text-white rounded hover:bg-Biru"
                            >
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import BarChartKeterangan from "@/Components/Chart/BarChartKeterangan.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        BarChartKeterangan,
    },
    props: {
        totalSuratMasuk: Number,
        totalSuratKeluar: Number,
        jenisSurat: Object,
        dataArsip: Object,
    },
    methods: {
        prevPage() {
            if (this.dataArsip.prev_page_url) {
                Inertia.visit(this.dataArsip.prev_page_url);
            }
        },
        nextPage() {
            if (this.dataArsip.next_page_url) {
                Inertia.visit(this.dataArsip.next_page_url);
            }
        },
    },
};
</script>
