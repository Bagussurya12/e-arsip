<template>
    <Head title="Arsip" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Kelola Data Arsip
            </h3>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="p-6 m-6 text-white bg-Biru rounded-xl mb-5">
                    <div class="justify-between items-center">
                        <h5 class="text-white text-center mb-10">
                            Kelola Data Arsip Untuk Menyimpan dan menjaga
                            konsistensi Data 🤞
                        </h5>
                        <SearchDocument
                            :filters="searchFilters"
                            @search="handleSearch"
                            @submit.prevent="search"
                        ></SearchDocument>
                    </div>
                </div>
                <!-- Garis horizontal di atas tabel -->
                <div class="w-full border-t border-slate-700"></div>

                <div class="p-6 text-Dark overflow-auto">
                    <div class="flex justify-between items-center mb-10">
                        <div class="flex items-center">
                            <label class="mr-2">
                                Total Data Arsip: {{ arsip.total || 0 }}
                            </label>
                        </div>
                        <Link
                            :href="route('arsip.create')"
                            class="bg-Orange hover:text-white text-white font-bold py-2 px-4 rounded"
                        >
                            Tambah Data Arsip
                        </Link>
                    </div>

                    <div class="overflow-x-auto table-container">
                        <!-- Tabel dengan garis pada header -->
                        <div class="table-scroll">
                            <table class="w-full border-2 border-slate-500">
                                <thead
                                    class="sticky-header top-0 bg-Biru text-white border-2 border-slate-500"
                                >
                                    <tr class="border-2 border-slate-500">
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            No
                                        </th>
                                        <th
                                            class="px-8 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Keterangan
                                        </th>
                                        <th
                                            class="px-18 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Jenis Surat
                                        </th>
                                        <th
                                            class="px-32 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Asal Surat
                                        </th>
                                        <th
                                            class="px-18 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Tanggal Surat
                                        </th>
                                        <th
                                            class="px-64 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Uraian Informasi Arsip
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            No Urut Perbulan
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            No Dokumen
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            colspan="3"
                                        >
                                            Lokasi Simpan
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Jumlah
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Tingkat Perkembangan
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Jenis Media
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Media
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Disposisi
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            Diteruskan Kepada
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                            rowspan="2"
                                        >
                                            #
                                        </th>
                                    </tr>
                                    <tr
                                        class="text-center border-2 border-slate-500"
                                    >
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                        >
                                            Kolom Lemari
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                        >
                                            Kotak A
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-white"
                                        >
                                            Kotak B
                                        </th>
                                    </tr>
                                </thead>
                                <!-- Body Table -->
                                <tbody class="border-2 border-slate-500">
                                    <tr
                                        v-for="(
                                            arsipItem, index
                                        ) in displayedArsip"
                                        :key="arsipItem.id"
                                        class="border-2 border-slate-500"
                                    >
                                        <td class="px-6 py-4 text-center">
                                            {{ index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.keterangan }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.jenis_surat }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.asal_surat }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.tanggal }}/{{
                                                arsipItem.bulan
                                            }}/{{ arsipItem.tahun }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.uraian_informasi }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.nomor_urut_perbulan }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ arsipItem.nomor_dokumen }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{
                                                arsipItem.lokasi_simpan
                                                    .kolom_lemari
                                            }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                v-if="
                                                    arsipItem.lokasi_simpan
                                                        .kotak === 'A'
                                                "
                                                >✔️</span
                                            >
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                v-if="
                                                    arsipItem.lokasi_simpan
                                                        .kotak === 'B'
                                                "
                                                >✔️</span
                                            >
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.jumlah }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.tingkat_perkembangan }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.jenis_media }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            <a
                                                :href="`/storage/${arsipItem.media}`"
                                                target="_blank"
                                                class="text-blue-600 hover:underline"
                                                >Lihat Media</a
                                            >
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.disposisi }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ arsipItem.terusan }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <Link
                                                :href="
                                                    route('arsip.edit', {
                                                        arsipId: arsipItem.id,
                                                    })
                                                "
                                                class="bg-Biru hover:text-Orange text-white font-base py-2 px-4 rounded"
                                                >Edit</Link
                                            >
                                            <button
                                                @click="
                                                    confirmDelete(arsipItem)
                                                "
                                                class="bg-Orange hover:text-Biru text-white font-base py-2 px-4 rounded"
                                            >
                                                Hapus
                                            </button>
                                            <Link
                                                :href="
                                                    route('arsip.detail', {
                                                        arsipId: arsipItem.id,
                                                    })
                                                "
                                                class="bg-Biru hover:text-Orange text-white font-base py-2 px-4 rounded"
                                                >Detail</Link
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button
                            @click="prevPage"
                            :disabled="!arsip.prev_page_url"
                            class="px-4 py-2 mr-2 bg-Orange text-white rounded"
                        >
                            Sebelumnya
                        </button>
                        <button
                            @click="nextPage"
                            :disabled="!arsip.next_page_url"
                            class="px-4 py-2 bg-Orange text-white rounded"
                        >
                            Selanjutnya
                        </button>
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
                                    Hapus Data Arsip
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
import { ref, computed } from "vue";
import { defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SearchDocument from "@/Components/SearchDocument.vue";

const props = defineProps({
    arsip: Object,
});

let dialogDelete = ref(false); // Gunakan ref untuk variabel reactive
let itemDelete = ref(null); // Gunakan ref untuk variabel reactive

// Mengelola navigasi halaman
const prevPage = () => {
    if (props.arsip.prev_page_url) {
        Inertia.visit(props.arsip.prev_page_url);
    }
};

const nextPage = () => {
    if (props.arsip.next_page_url) {
        Inertia.visit(props.arsip.next_page_url);
    }
};

// Fungsi untuk menampilkan konfirmasi hapus
const confirmDelete = (arsipItem) => {
    itemDelete.value = arsipItem; // Menggunakan langsung
    dialogDelete.value = true; // Menggunakan langsung
};

const hapus = (arsipItem) => {
    deleteArsip(arsipItem.id); // Menggunakan arsipItem.id karena sudah sesuai
};

// Fungsi untuk menghapus data arsip dengan HTTP DELETE
const deleteArsip = (arsipId) => {
    Inertia.delete(route("arsip.delete", { id: arsipId })).then(() => {
        Inertia.reload();
    });
    closeDelete();
};

const closeDelete = () => {
    dialogDelete.value = false;
    itemDelete.value = null;
};

const search = () => {
    // Pastikan searchFilters dan searchQuery terdefinisi dengan benar
    const queryParams = {
        naskahDinas:
            searchFilters && searchFilters.naskahDinas
                ? searchFilters.naskahDinas
                : "",
        searchQuery: searchQuery ? searchQuery : "",
        filterBulan:
            searchFilters && searchFilters.filterBulan
                ? searchFilters.filterBulan
                : "",
        tahun: searchFilters && searchFilters.tahun ? searchFilters.tahun : "",
        filterMediaArsip:
            searchFilters && searchFilters.filterMediaArsip
                ? searchFilters.filterMediaArsip
                : "",
    };

    const queryString = new URLSearchParams(queryParams).toString();
    Inertia.visit(route("arsip.index") + "?" + queryString);
};

const searchQuery = ref("");
const searchFilters = ref({
    naskahDinas: "",
    uraianInformasi: "",
    tanggal: "",
    filterBulan: "",
    tahun: "",
});

const displayedArsip = computed(() => {
    if (
        searchQuery.value.trim() === "" &&
        searchFilters.value.naskahDinas === "" &&
        searchFilters.value.asalSurat === "" &&
        searchFilters.value.uraianInformasi === "" &&
        searchFilters.value.tanggal === "" &&
        searchFilters.value.filterBulan === "" &&
        searchFilters.value.tahun === ""
    ) {
        return props.arsip.data;
    } else {
        return props.arsip.data.filter((arsip) => {
            const filterNaskahDinas =
                !searchFilters.value.naskahDinas ||
                arsip.jenis_surat.toLowerCase() ===
                    searchFilters.value.naskahDinas.toLowerCase();

            const filterAsalSurat =
                !searchFilters.value.asalSurat ||
                arsip.asal_surat.toLowerCase() ===
                    searchFilters.value.asalSurat.toLowerCase();

            const filterUraian =
                !searchFilters.value.uraianInformasi ||
                arsip.uraian_informasi.toLowerCase() ===
                    searchFilters.value.uraianInformasi.toLowerCase();

            const filterTanggal =
                !searchFilters.value.tanggal ||
                arsip.tanggal === searchFilters.value.tanggal;

            const filterBulan =
                !searchFilters.value.filterBulan ||
                arsip.bulan === searchFilters.value.filterBulan;

            const filterTahun =
                searchFilters.value.tahun === "" ||
                arsip.tahun === searchFilters.value.tahun;

            return (
                filterNaskahDinas &&
                filterAsalSurat &&
                filterUraian &&
                filterTanggal &&
                filterBulan &&
                filterTahun
            );
        });
    }
});

const handleSearch = (filters) => {
    // Lakukan sesuatu dengan filters yang diterima dari SearchDocument
    searchFilters.value = filters; // Contoh, menyimpan filter di variabel ref
    search(); // Panggil fungsi search setelah mendapat filters
};
</script>
<style>
.sticky-header {
    position: -webkit-sticky; /* Safari */
    position: sticky;
    top: 0;
    border: 10px;
    z-index: 10; /* Pastikan header tetap di atas konten lainnya */
}

.table-container {
    overflow-y: auto;
    height: 650px; /* Atur sesuai kebutuhan Anda */
    position: relative;
}
.table-scroll {
    max-height: 650px; /* Atur tinggi sesuai kebutuhan */
    overflow-y: scroll; /* Mengaktifkan scroll vertikal */
    scrollbar-width: thin; /* Untuk Firefox */
}

.table-scroll::-webkit-scrollbar {
    width: 0; /* Menyembunyikan scrollbar di Chrome, Safari, dan Opera */
}

table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    border: 2px solid #6b7280; /* border-slate-500 */
}

thead th {
    position: sticky;
    top: 0;
    z-index: 1;
}
</style>
