<template>
    <Head title="Detail Data Pengadaan" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight mt-5 text-center mb-5">
                Detail Data Pengadaan
            </h3>
            <div class="flex mb-4">
                <strong class="w-1/3">Judul Pengadaan</strong>
                    <span class="w-2/3">: {{ procurement.title }}</span>
             </div>
            <div class="flex mb-4">
                <strong class="w-1/3">Nomor Pengadaan</strong>
                    <span class="w-2/3">: {{ procurement.procurement_number }}</span>
             </div>
            <div class="flex mb-4">
                <strong class="w-1/3">Status Pengadaan</strong>
                    <span class="w-2/3">: {{ procurement.status }}</span>
             </div>
            <div class="flex mb-4">
                <strong class="w-1/3">Tanggal Pengadaan</strong>
                    <span class="w-2/3">: {{ procurement.tanggal }} {{ procurement.bulan }} {{ procurement.tahun }}</span>
             </div>
             <div class="flex mb-4">
                <strong class="w-1/3">Deskripsi Pengadaan</strong>
                    <span class="w-2/3">: {{ procurement.remarks }}</span>
             </div>
        </template>
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-Dark overflow-auto">
                        <div class="flex justify-end items-center mb-10">
                            <div class="flex-1 text-center">
                                <h4 class="font-bold text-xl">Surat</h4>
                            </div>
                            <Link
                                :href="route('procurement.surat.create', { id: procurement.id })"
                                class="bg-Biru hover:text-white text-white font-bold py-2 px-4 rounded mx-5"
                            >
                                Tambah Surat
                            </Link>

                        </div>
                        <!-- Surat -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="mb-5">
                                    <tr class="border-b-2">
                                        <th
                                            class="px-2 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            No
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Jenis Surat
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Nomor Surat
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Tanggal Surat
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Asal Surat
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            #
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr
                                        v-for="(arsipItem, index) in arsip"
                                        :key="arsipItem.id"
                                    >
                                        <td class="px-2 py-4 text-center">
                                            {{ index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.jenis_surat }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.nomor_dokumen }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.tanggal }} {{ arsipItem.bulan }} {{ arsipItem.tahun }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.asal_surat }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <Link
                                                        :href="
                                                            route(
                                                                'procurement.surat.edit',
                                                                {
                                                                    arsipId:
                                                                        arsipItem.id,
                                                                }
                                                            )
                                                        "
                                                        class="bg-Biru hover:text-Orange text-white font-base py-2 px-6 rounded"
                                                        >Edit</Link
                                                    >
                                                    <button
                                                        @click="confirmDelete(arsipItem, 'surat')"
                                                        class="bg-Orange hover:text-Biru text-white font-base py-2 px-4 rounded"
                                                    >
                                                        Hapus
                                                    </button>
                                                <Link
                                                        :href="
                                                            route(
                                                                'arsip.detail',
                                                                {
                                                                    arsipId:
                                                                        arsipItem.id,
                                                                }
                                                            )
                                                        "
                                                        class="bg-Biru hover:text-Orange text-white font-base py-2 px-4 rounded"
                                                        >Detail</Link
                                                    >
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Dokumentasi -->
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 py-10">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-Dark overflow-auto">
                        <div class="flex justify-end items-center mb-10">
                            <div class="flex-1 text-center">
                                <h4 class="font-bold text-xl">Dokumentasi</h4>
                            </div>
                            <Link
                                :href="route('procurement.dokumentasi.create', { id: procurement.id })"
                                class="bg-Orange hover:text-white text-white font-bold py-2 px-4 rounded"
                            >
                                Tambah Dokumentasi
                            </Link>
                        </div>
                         <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="mb-5">
                                    <tr class="border-b-2">
                                        <th
                                            class="px-2 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            No
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Nama Dokumentasi
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Tanggal
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                        Media
                                        </th>

                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            #
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr
                                        v-for="(dokumentasiItem, index) in dokumentasi"
                                        :key="dokumentasiItem.id"
                                    >
                                        <td class="px-2 py-4 text-center">
                                            {{ index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ dokumentasiItem.title }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ dokumentasiItem.tanggal }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a
                                                    :href="`/storage/${dokumentasiItem.foto}`"
                                                    target="_blank"
                                                    class="text-blue-600 hover:underline"
                                                    >Lihat Media</a
                                                >
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <Link
                                                        :href="
                                                            route(
                                                                'procurement.dokumentasi.edit',
                                                                {
                                                                    dokumentasiId:
                                                                        dokumentasiItem.id,
                                                                }
                                                            )
                                                        "
                                                        class="bg-Biru hover:text-Orange text-white font-base py-2 px-6 rounded"
                                                        >Edit</Link
                                                    >
                                                    <button
                                                        @click="confirmDelete(dokumentasiItem, 'dokumentasi')"
                                                        class="bg-Orange hover:text-Biru text-white font-base py-2 px-4 rounded"
                                                    >
                                                        Hapus
                                                    </button>
                                                <Link
                                                        :href="
                                                            route(
                                                                'procurement.dokumentasi.detail',
                                                                {
                                                                    dokumentasiId:
                                                                        dokumentasiItem.id,
                                                                }
                                                            )
                                                        "
                                                        class="bg-Biru hover:text-Orange text-white font-base py-2 px-4 rounded"
                                                        >Detail</Link
                                                    >
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Hapus -->
            <div v-if="dialogDelete" class="fixed z-10 inset-0 overflow-y-auto">
                <div
                    class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
                >
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span
                        class="hidden sm:inline-block sm:align-middle sm:h-screen"
                        aria-hidden="true"
                    >&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                    >
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                            >
                                <svg
                                    class="h-6 w-6 text-red-600"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    ></path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Hapus Data Pengadaan
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-Dark">
                                        Apakah Kamu Yakin Ingin Menghapus Data Ini? Tindakan Ini Tidak Bisa Dikembalikan.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto mx-3">
                                <button
                                    @click="hapus(itemDelete)"
                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-Dark text-base leading-6 font-medium text-white shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                >
                                    Hapus
                                </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto mx-3">
                                <button
                                    @click="closeDelete"
                                    type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-Dark px-4 py-2 bg-white text-base leading-6 font-medium text-Dark shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                >
                                    Batal
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Konfirmasi Hapus -->
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, computed } from "vue";
import { defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    procurement: Object,
    arsip: Object,
    dokumentasi: Object,

});

// ref untuk modal konfirmasi hapus
let dialogDelete = ref(false);
let itemDelete = ref(null);
let deleteType = ref('');

// fungsi untuk menampilkan modal konfirmasi hapus
const confirmDelete = (item, type) => {
    itemDelete.value = item;
    deleteType.value = type; // Simpan tipe data yang akan dihapus (surat/dokumentasi)
    dialogDelete.value = true;
};

const hapus = () => {
    deleteItem(itemDelete.value.id, deleteType.value); // Panggil fungsi universal dengan id item dan tipe data
};

const deleteItem = (itemId, type) => {
    // Tentukan rute berdasarkan tipe data yang dihapus
    if (type === 'surat') {
        Inertia.delete(route("procurement.surat.delete", { id: itemId })).then(() => {
            Inertia.reload();
        });
    } else if (type === 'dokumentasi') {
        Inertia.delete(route("procurement.dokumentasi.delete", { id: itemId })).then(() => {
            Inertia.reload();
        });
    }
    closeDelete();
};

// fungsi untuk menutup modal konfirmasi hapus
const closeDelete = () => {
    dialogDelete.value = false;
    itemDelete.value = null;
    deleteType.value = ''; // Reset tipe data
};
</script>
