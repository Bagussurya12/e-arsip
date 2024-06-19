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
                <div class="p-6 m-6 text-white bg-Dark rounded-xl mb-5">
                    <div class="justify-between items-center">
                        <h5 class="text-white text-center mb-10">
                            Kelola Data Arsip Untuk Menyimpan dan menjaga
                            konsistensi Data 🤞
                        </h5>
                        <form
                            action=""
                            class="flex justify-center flex-wrap w-full mx-auto text-Dark"
                            @submit.prevent="search"
                        >
                            <!-- Select Naskah Dinas -->
                            <div
                                class="w-1/6 bg-white text-sm text-Dark rounded-l-lg border-transparent border-none px-2"
                            >
                                <select
                                    id="selectNaskah"
                                    name="naskahDinas"
                                    v-model="searchFilters.naskahDinas"
                                    class="truncate w-full border-none focus:outline-none focus:ring-0 text-Dark"
                                >
                                    <option disabled value="" selected>
                                        Naskah Dinas
                                    </option>
                                    <option
                                        v-for="naskahDinas in NaskahDinasGroup"
                                        :key="naskahDinas"
                                        :value="naskahDinas"
                                        class="text-Black focus:outline-none text-Dark"
                                    >
                                        {{ naskahDinas }}
                                    </option>
                                </select>
                            </div>
                            <!-- Input Nomor Naskah Dinas -->
                            <div
                                class="w-1/6 bg-white text-sm border-transparent"
                            >
                                <input
                                    id="uraianInformasi"
                                    type="text"
                                    class="w-full border-none focus:outline-none focus:ring-0 text-Dark"
                                    placeholder="Uraian Informasi"
                                    v-model="searchQuery"
                                />
                            </div>
                            <!-- Select Bulan -->
                            <div
                                class="w-1/6 bg-white text-sm border-transparent"
                            >
                                <select
                                    id="selectBulan"
                                    name="map_bulan"
                                    class="truncate w-full border-none focus:outline-none focus:ring-0 text-Dark"
                                    v-model="searchFilters.filterBulan"
                                >
                                    <option disabled value="" selected>
                                        Bulan
                                    </option>
                                    <option
                                        v-for="bulan in optionBulan"
                                        :key="bulan"
                                        :value="bulan"
                                        class="text-Dark rounded-lg"
                                    >
                                        {{ bulan }}
                                    </option>
                                </select>
                            </div>
                            <!-- Select Tahun -->
                            <div
                                class="w-1/6 bg-white text-sm border-transparent"
                            >
                                <input
                                    type="number"
                                    class="w-full border-none focus:outline-none focus:ring-0 text-Dark"
                                    placeholder="Tahun"
                                    v-model="searchFilters.tahun"
                                />
                            </div>
                            <!-- Select Media Arsip -->
                            <div
                                class="w-1/6 bg-white text-sm border-transparent border-none px-2"
                            >
                                <select
                                    id="selectMedia"
                                    name="mediaArsip"
                                    class="truncate w-full border-none focus:outline-none focus:ring-0 text-Dark"
                                    v-model="searchFilters.filterMediaArsip"
                                >
                                    <option disabled value="" selected>
                                        Media Arsip
                                    </option>
                                    <option
                                        v-for="mediaArsip in MediaArsipGroup"
                                        :key="mediaArsip"
                                        :value="mediaArsip"
                                        class="text-Dark rounded-lg"
                                    >
                                        {{ mediaArsip }}
                                    </option>
                                </select>
                            </div>
                            <!-- Button Cari -->
                            <div
                                class="w-auto bg-white text-sm rounded-r-lg border-transparent border-none px-2"
                            >
                                <button
                                    type="submit"
                                    class="flex items-center justify-center h-full px-3 py-2 w-10 text-Dark rounded-lg focus:outline-none"
                                >
                                    <svg
                                        role="img"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <title>Cari</title>
                                        <path
                                            d="m13.716 17.261 6.873 6.582L24 20.282l-6.824-6.536a9.11 9.11 0 0 0 1.143-4.43c0-5.055-4.105-9.159-9.16-9.159S0 4.261 0 9.316c0 5.055 4.104 9.159 9.159 9.159a9.11 9.11 0 0 0 4.557-1.214ZM9.159 2.773a6.546 6.546 0 0 1 6.543 6.543 6.545 6.545 0 0 1-6.543 6.542 6.545 6.545 0 0 1-6.542-6.542 6.545 6.545 0 0 1 6.542-6.543ZM7.26 5.713a4.065 4.065 0 0 1 4.744.747 4.064 4.064 0 0 1 .707 4.749l1.157.611a5.376 5.376 0 0 0-.935-6.282 5.377 5.377 0 0 0-6.274-.987l.601 1.162Z"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </form>
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
                            class="bg-Dark hover:text-Hijau text-white font-bold py-2 px-4 rounded"
                        >
                            Tambah Data Arsip
                        </Link>
                    </div>

                    <div class="overflow-x-auto">
                        <!-- Tabel dengan garis pada header -->
                        <table class="w-full border-2">
                            <thead class="mb-5 border-2 border-white text-Dark">
                                <tr class="text-center border-2 border-Dark">
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        Jenis Arsip
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        colspan="3"
                                    >
                                        Kolom Simpan
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        No Urut Perbulan
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        No Dokumen
                                    </th>
                                    <th
                                        class="px-24 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        Uraian Informasi Arsip
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        Asal Surat
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        Tgl Surat
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        Jumlah
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        Tingkat Perkembangan
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        Keterangan
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        Jenis Media
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        Media
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                        rowspan="2"
                                    >
                                        #
                                    </th>
                                </tr>
                                <tr class="text-center border-2 border-Dark">
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                    >
                                        Kolom Lemari
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                    >
                                        No Bindeks
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark border-2 border-Dark"
                                    >
                                        Map Bulan
                                    </th>
                                </tr>
                            </thead>
                            <!-- Body Table -->
                            <tbody>
                                <tr
                                    v-for="(arsipItem, index) in displayedArsip"
                                    :key="arsipItem.id"
                                    class="border-2 border-Dark"
                                >
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ index + 1 }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.jenis_arsip }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{
                                            arsipItem.lokasi_simpan
                                                ?.kolom_lemari ?? "-"
                                        }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{
                                            arsipItem.lokasi_simpan
                                                ?.no_bindeks ?? "-"
                                        }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{
                                            arsipItem.lokasi_simpan
                                                ?.map_bulan ?? "-"
                                        }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.nomor_urut_perbulan }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.nomor_dokumen }}
                                    </td>
                                    <td
                                        class="px-8 py-2 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.uraian_informasi }}
                                    </td>
                                    <td
                                        class="px-8 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.asal_surat }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.tanggal_surat }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.jumlah }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.tingkat_perkembangan }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.keterangan }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.jenis_media }}
                                    </td>
                                    <td
                                        class="px-6 py-2 text-center border-2 border-Dark"
                                    >
                                        <a
                                            :href="`/storage/${arsipItem.media}`"
                                            target="_blank"
                                            class="text-blue-600 hover:underline"
                                        >
                                            Lihat Media
                                        </a>
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-Dark flex space-x-2"
                                    >
                                        <Link
                                            :href="
                                                route('arsip.edit', {
                                                    arsipId: arsipItem.id,
                                                })
                                            "
                                            class="bg-Dark hover:text-Hijau text-white font-base py-2 px-4 rounded"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="confirmDelete(arsipItem)"
                                            class="bg-Dark hover:text-Hijau text-white font-base py-2 px-4 rounded"
                                        >
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-10">
                        <button
                            @click="prevPage"
                            :disabled="!arsip.prev_page_url"
                            class="px-4 py-2 mr-2 bg-Dark text-white rounded"
                        >
                            Sebelumnya
                        </button>
                        <button
                            @click="nextPage"
                            :disabled="!arsip.next_page_url"
                            class="px-4 py-2 bg-Dark text-white rounded"
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
    filterBulan: "",
    tahun: "",
    filterMediaArsip: "",
});
const NaskahDinasGroup = [
    "Instruksi",
    "Surat Perintah",
    "Surat Keterangan",
    "Surat Biasa",
    "Surat Perintah Tugas",
    "Surat Tugas",
    "Surat Kuasa",
    "Surat Undangan",
    "Surat Edaran",
    "Surat Keputusan",
    "Surat Perjanjian",
    "Surat Laporan",
    "Nota Dinas",
    "Nota Pengajuan Naskah Dinas",
    "Telaahan Staf",
    "Lain-lain",
];

let MediaArsipGroup = ["PDF", "Gambar", "Vidio", "Audio", "Lain-lain"];

let optionBulan = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
];

const displayedArsip = computed(() => {
    if (
        searchQuery.value.trim() === "" &&
        searchFilters.value.naskahDinas === "" &&
        searchFilters.value.filterBulan === "" &&
        searchFilters.value.tahun === "" &&
        searchFilters.value.filterMediaArsip === ""
    ) {
        return props.arsip.data;
    } else {
        return props.arsip.data.filter((arsip) => {
            const filterNaskahDinas =
                !searchFilters.value.naskahDinas ||
                arsip.jenis_arsip.toLowerCase() ===
                    searchFilters.value.naskahDinas.toLowerCase();

            const filterUraian =
                searchQuery.value.trim() === "" ||
                arsip.uraian_informasi
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase());

            const filterBulan =
                !searchFilters.value.filterBulan ||
                arsip.lokasi_simpan.map_bulan.toLowerCase() ===
                    searchFilters.value.filterBulan.toLowerCase();

            const filterTahun =
                searchFilters.value.tahun === "" || // Jika searchFilters.value.tahun kosong, lewati filter tahun
                arsip.lokasi_simpan.tahun === searchFilters.value.tahun;

            const filterMediaArsip =
                !searchFilters.value.filterMediaArsip ||
                arsip.jenis_media.toLowerCase() ===
                    searchFilters.value.filterMediaArsip.toLowerCase();

            return (
                filterNaskahDinas &&
                filterUraian &&
                filterBulan &&
                filterTahun &&
                filterMediaArsip
            );
        });
    }
});
</script>

<style>
select {
    color: black;
}
</style>
