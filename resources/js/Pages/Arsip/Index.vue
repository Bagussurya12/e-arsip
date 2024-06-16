<template>
    <Head title="Arsip" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Kelola Data Arsip
            </h3>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-Dark-900">
                    <div class="flex justify-between items-center">
                        <h5 class="text-Dark">
                            Kelola Data Arsip Untuk Menyimpan dan menjaga
                            konsistensi Data 🤞
                        </h5>
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
                                        class="px-6 py-4 text-center border-2 border-Dark"
                                    >
                                        {{ arsipItem.uraian_informasi }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center border-2 border-Dark"
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
                                        class="px-6 py-4 text-center border-2 border-Dark"
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
                                        class="px-6 py-4 text-center border-2 border-Dark"
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
                            Previous
                        </button>
                        <button
                            @click="nextPage"
                            :disabled="!arsip.next_page_url"
                            class="px-4 py-2 bg-Dark text-white rounded"
                        >
                            Next
                        </button>
                    </div>
                </div>
            </div>
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
const searchQuery = ref("");

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
const displayedArsip = computed(() => {
    if (searchQuery.value.trim() === "") {
        // Jika query kosong, tampilkan semua data arsip
        return props.arsip.data;
    } else {
        // Jika query tidak kosong, filter data arsip sesuai dengan query
        return props.arsip.data.filter((arsip) =>
            arsip.uraian_informasi.toLowerCase.includes(
                searchQuery.value.toLowerCase()
            )
        );
    }
});
console.log(props.arsip.data);
</script>
