<script setup>
import { defineProps, onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
    arsipTerbaru: Array,
});

onMounted(() => {
    router.visit("/arsip-terbaru", {
        preserveState: true,
        preserveScroll: true,
    });
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">
                            Data Arsip Terbaru
                        </h3>
                        <div
                            v-if="
                                props.arsipTerbaru &&
                                props.arsipTerbaru.length === 0
                            "
                            class="flex flex-col items-center justify-center mt-10"
                        >
                            <h1 class="font-bold text-2xl">
                                Belum Ada Data Arsip Terbaru
                            </h1>
                            <img
                                src="../../../assets/img/bingung.png"
                                alt="Confused Image"
                                class="max-w-[300px] mt-4"
                            />
                        </div>
                        <table
                            v-else-if="
                                props.arsipTerbaru &&
                                props.arsipTerbaru.length > 0
                            "
                            class="min-w-full divide-y divide-gray-200"
                        >
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Jenis Surat
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Asal Surat
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Tanggal
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Uraian Informasi
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Disposisi
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Terusan
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Lokasi Simpan
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="arsip in props.arsipTerbaru"
                                    :key="arsip.id"
                                >
                                    <td class="px-6 py-4 text-center">
                                        {{ arsip.jenis_surat }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ arsip.asal_surat }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ arsip.tanggal }}-{{ arsip.bulan }}-{{
                                            arsip.tahun
                                        }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ arsip.uraian_informasi }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ arsip.disposisi }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ arsip.terusan }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div v-if="arsip.lokasi_simpan">
                                            Kolom:
                                            {{
                                                arsip.lokasi_simpan
                                                    .kolom_lemari
                                            }}, Kotak:
                                            {{ arsip.lokasi_simpan.kotak }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
