<template>
    <Head title="Format Surat" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Format Surat
            </h3>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center">
                            <h5 class="text-Dark text-center mb-10">
                                Gunakan Format Surat Untuk Mempermudah dalam
                                Membuat dan Mengarsipkan Surat ✨
                            </h5>
                            <input
                                type="text"
                                v-model="searchQuery"
                                @input="search"
                                @keyup.enter="search"
                                placeholder="Cari Format Surat disini"
                                class="ml-4 p-2 border border-Dark rounded min-w-[200px] focus:ring-black"
                            />
                        </div>
                    </div>
                    <div class="w-full border-t border-slate-700"></div>
                    <div class="p-6 text-Dark overflow-auto">
                        <div class="flex justify-between items-center mb-10">
                            <Link
                                :href="route('format.create')"
                                class="bg-Orange hover:text-white text-white font-bold py-2 px-4 rounded"
                            >
                                Tambah Format Surat
                            </Link>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="mb-5">
                                    <tr class="border-b-2 border-slate-700">
                                        <th
                                            class="px-4 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            No
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            Nama Format Surat
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                        >
                                            #
                                        </th>
                                    </tr>
                                </thead>
                                <!-- BODY TABLE -->
                                <tbody>
                                    <tr
                                        v-for="(
                                            formatSuratItem, index
                                        ) in format_surat"
                                        :key="formatSuratItem.id"
                                        class="border-b"
                                    >
                                        <td class="px-4 py-2 text-center">
                                            {{ index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ formatSuratItem.title }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div
                                                class="flex justify-center space-x-2"
                                            >
                                                <Link
                                                    :href="
                                                        route('format.edit', {
                                                            format: formatSuratItem.id,
                                                        })
                                                    "
                                                    class="bg-Biru hover:text-Orange text-white font-base py-2 px-6 rounded"
                                                    >Edit</Link
                                                >
                                                <button
                                                    @click="
                                                        confirmDelete(
                                                            formatSuratItem
                                                        )
                                                    "
                                                    class="bg-Orange hover:text-Biru text-white font-base py-2 px-4 rounded"
                                                >
                                                    Hapus
                                                </button>

                                                <a
                                                    :href="`/storage/${formatSuratItem.file_surat}`"
                                                    download
                                                    class="bg-Biru hover:text-Orange text-white font-base py-2 px-4 rounded"
                                                >
                                                    Unduh
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Garis horizontal di atas tabel -->
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
                                    Hapus Data Format Surat
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
                                    Cancel
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
import { ref, watchEffect } from "vue";
import { defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    format_surat: {
        type: Array,
        required: true,
    },
    search: {
        type: String,
        default: "",
    },
});

let searchQuery = ref(props.search);
let dialogDelete = ref(false);
let itemDelete = ref(null);

watchEffect(() => {
    searchQuery.value = props.search;
});

const search = () => {
    Inertia.get(
        route("format.index"),
        { search: searchQuery.value },
        { preserveState: true }
    );
};

const confirmDelete = (formatSuratItem) => {
    itemDelete.value = formatSuratItem;
    dialogDelete.value = true;
};

const hapus = (formatSuratItem) => {
    Inertia.delete(route("format.delete", { format: formatSuratItem.id })).then(
        () => {
            dialogDelete.value = false;
            itemDelete.value = null;
        }
    );
};

const closeDelete = () => {
    dialogDelete.value = false;
    itemDelete.value = null;
};
</script>
