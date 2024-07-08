<template>
    <Head title="Data Terusan" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Daftar Data Terusan
            </h3>
        </template>
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-Dark overflow-auto">
                    <div class="flex justify-between items-center mb-10">
                        <div class="flex items-center">
                            <label class="mr-2">
                                Total Data Terusan: {{ terusan.length }}
                            </label>
                        </div>
                        <Link
                            :href="route('terusan.create')"
                            class="bg-Orange hover:text-white text-white font-bold py-2 px-4 rounded"
                        >
                            Tambah Data Terusan
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
                                        Nama Data
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="(terusanItem, index) in terusan"
                                    :key="terusanItem.id"
                                >
                                    <td class="px-2 py-4 text-center">
                                        {{ index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ terusanItem.value }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div
                                            class="flex justify-center space-x-2"
                                        >
                                            <Link
                                                :href="
                                                    route('terusan.edit', {
                                                        terusan: terusanItem.id,
                                                    })
                                                "
                                                class="bg-Biru hover:text-Orange text-white font-base py-2 px-4 rounded"
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                @click="
                                                    confirmDelete(terusanItem)
                                                "
                                                class="bg-Orange hover:text-Biru text-white font-base py-2 px-4 rounded"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Hapus -->
            <div v-if="dialogDelete" class="fixed z-10 inset-0 overflow-y-auto">
                <div
                    class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
                >
                    <div
                        class="fixed inset-0 transition-opacity"
                        aria-hidden="true"
                    >
                        <div
                            class="absolute inset-0 bg-gray-500 opacity-75"
                        ></div>
                    </div>
                    <span
                        class="hidden sm:inline-block sm:align-middle sm:h-screen"
                        aria-hidden="true"
                        >&#8203;</span
                    >
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
                            <div
                                class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                            >
                                <h3
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Hapus Data Terusan
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-Dark">
                                        Apakah Kamu Yakin Ingin Menghapus Data
                                        Ini? Tindakan Ini Tidak Bisa
                                        Dikembalikan.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <span
                                class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto mx-3"
                            >
                                <button
                                    @click="hapus(itemDelete)"
                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-Dark text-base leading-6 font-medium text-white shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                >
                                    Hapus
                                </button>
                            </span>
                            <span
                                class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto mx-3"
                            >
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
    terusan: Object,
});

// ref untuk modal konfirmasi hapus
let dialogDelete = ref(false);
let itemDelete = ref(null);

// fungsi untuk menampilkan modal konfirmasi hapus
const confirmDelete = (terusanItem) => {
    itemDelete.value = terusanItem;
    dialogDelete.value = true;
};
const hapus = (terusanItem) => {
    deleteTerusan(terusanItem.id); // Menggunakan arsipItem.id karena sudah sesuai
};

// fungsi untuk menghapus data terusan
const deleteTerusan = (terusanId) => {
    Inertia.delete(route("terusan.delete", { id: terusanId })).then(() => {
        Inertia.reload();
    });
    closeDelete();
};

// fungsi untuk menutup modal konfirmasi hapus
const closeDelete = () => {
    dialogDelete.value = false;
    itemDelete.value = null;
};
</script>
