<template>
    <Head title="Data Pengadaan" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Daftar Data Pengadaan Barang dan Jasa
            </h3>
        </template>
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="p-6 m-6 text-white bg-Biru rounded-xl mb-5">
                    <div class="justify-between items-center">
                        <SearchPengadaan
                            :filters="searchFilters"
                            @submit.prevent="search"
                        ></SearchPengadaan>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-Dark overflow-auto">
                        <div
                        v-if="!displayedPengadaan.length"
                        class="flex flex-col items-center justify-center mt-10"
                    >
                        <h1 class="font-bold text-2xl font-mono text-center">
                            Data Pengadaan Tidak Ditemukan, <br />
                            Cari Data Yang Lain Ya!
                        </h1>
                        <img
                            src="../../../../assets/img/bingung.png"
                            alt="Confused Image"
                            class="max-w-[400px] mt-4"
                        />
                        <Link
                            :href="route('procurement.create')"
                            class="bg-Biru  hover:text-white text-white font-bold py-2 px-24 text-center rounded hover:bg-Orange">
                            Tambah Data Pengadaan
                        </Link>
                    </div>
                        <div v-else>
                            <div class="flex justify-between items-center mb-10">
                                <div class="flex items-center">
                                    <label class="mr-2">
                                        Total Data Pengadaan: {{ procurements.total ?? '0'  }}
                                    </label>
                                </div>
                                <Link
                                    :href="route('procurement.create')"
                                    class="bg-Orange hover:text-white text-white font-bold py-2 px-4 rounded"
                                >
                                    Tambah Data Pengadaan
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
                                                Nama Pengadaan
                                            </th>
                                            <th
                                                class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                            >
                                                Nomor Pengadaan
                                            </th>
                                            <th
                                                class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                            >
                                                Tanggal Pengadaan
                                            </th>
                                            <th
                                                class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                            >
                                                Status
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
                                            v-for="(procurementItem, index) in displayedPengadaan"
                                            :key="procurementItem.id"
                                        >
                                            <td class="px-2 py-4 text-center">
                                                {{ index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ procurementItem.title }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ procurementItem.procurement_number }} <!-- perbaikan nama properti -->
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ procurementItem.tanggal }} {{ procurementItem.bulan }} {{ procurementItem.tahun }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ procurementItem.status }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <Link
                                                        :href="
                                                            route('procurement.edit', {
                                                                procurementId: procurementItem.id,
                                                            })
                                                        "
                                                        class="bg-Biru hover:text-Orange text-white font-base py-2 px-6 rounded"
                                                    >
                                                        Edit
                                                    </Link>
                                                    <button
                                                        @click="confirmDelete(procurementItem)"
                                                        class="bg-Orange hover:text-Biru text-white font-base py-2 px-4 rounded"
                                                    >
                                                        Hapus
                                                    </button>
                                                    <Link
                                                        :href="
                                                            route('procurement.details', {
                                                                procurementId: procurementItem.id,
                                                            })
                                                        "
                                                        class="bg-Biru hover:text-Orange text-white font-base py-2 px-6 rounded"
                                                    >
                                                    Detail
                                                    </Link>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button
                                @click="prevPage"
                                :disabled="!procurements.prev_page_url"
                                class="px-4 py-2 mr-2 bg-Orange hover:bg-Biru text-white rounded"
                            >
                                Sebelumnya
                            </button>
                            <button
                                @click="nextPage"
                                :disabled="!procurements.next_page_url"
                                class="px-4 py-2 bg-Orange hover:bg-Biru text-white rounded"
                            >
                                Selanjutnya
                            </button>
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
import SearchPengadaan from "@/Components/SearchPengadaan.vue";


const props = defineProps({
    procurements: Object,
});

const prevPage = () => {
    if (props.procurements.prev_page_url) {
        Inertia.visit(props.procurements.prev_page_url);
    }
};

const nextPage = () => {
    if (props.procurements.next_page_url) {
        Inertia.visit(props.procurements.next_page_url);
    }
};


// ref untuk modal konfirmasi hapus
let dialogDelete = ref(false);
let itemDelete = ref(null);

// fungsi untuk menampilkan modal konfirmasi hapus
const confirmDelete = (pengdaaanItem) => {
    itemDelete.value = pengdaaanItem;
    dialogDelete.value = true;
};
const hapus = (pengdaaanItem) => {
    deletePengdaaan(pengdaaanItem.id); // Menggunakan arsipItem.id karena sudah sesuai
};

// fungsi untuk menghapus data terusan
const deletePengdaaan = (procurementId) => {
    Inertia.delete(route("procurement.delete", { id: procurementId })).then(() => {
        Inertia.reload();
    });
    closeDelete();
};

// fungsi untuk menutup modal konfirmasi hapus
const closeDelete = () => {
    dialogDelete.value = false;
    itemDelete.value = null;
};

const search = () => {
    const queryParams = {
        searchQuery: searchQuery ? searchQuery : "",
        judul: searchFilters.value.judul || "",
        status: searchFilters.value.status || "",
        catatan: searchFilters.value.catatan || "",
        tanggal: searchFilters.value.tanggal || "",
        bulan: searchFilters.value.bulan || "",
        tahun: searchFilters.value.tahun || "",
    };

    const queryString = new URLSearchParams(queryParams).toString();
    Inertia.visit(route("procurement.index") + "?" + queryString);
};

const searchQuery = ref("");
const searchFilters = ref({
    judul: "",
    status: "",
    catatan: "",
    tanggal: "",
    bulan: "",
    tahun: "",
});

const displayedPengadaan = computed(() => {
    if (
        searchQuery.value.trim() === "" &&
        searchFilters.value.judul === "" &&
        searchFilters.value.status === "" &&
        searchFilters.value.catatan === "" &&
        searchFilters.value.tanggal === "" &&
        searchFilters.value.bulan === "" &&
        searchFilters.value.tahun === ""
    ) {
        return props.procurements.data;
    } else {
        return props.procurements.data.filter((procurements) => {
            const filterStatus =
                !searchFilters.value.status ||
                procurements.status.toLowerCase() ===
                    searchFilters.value.status.toLowerCase();

            const filterJudul =
                !searchFilters.value.judul ||
                procurements.title.toLowerCase() ===
                    searchFilters.value.judul.toLowerCase();

            const filterCatatan =
                !searchFilters.value.catatan ||
                procurements.catatan.toLowerCase() ===
                    searchFilters.value.catatan.toLowerCase();

            const filterTanggal =
                !searchFilters.value.tanggal ||
                procurements.tanggal === searchFilters.value.tanggal;

            const filterBulan =
                !searchFilters.value.bulan ||
                procurements.bulan === searchFilters.value.bulan;

            const filterTahun =
                searchFilters.value.tahun === "" ||
                procurements.tahun === searchFilters.value.tahun;

            return (
                filterStatus &&
                filterJudul &&
                filterCatatan &&
                filterTanggal &&
                filterBulan &&
                filterTahun
            );
        });
    }
});

</script>
