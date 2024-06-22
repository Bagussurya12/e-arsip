<template>
    <Head title="Pesan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Pesan
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center">
                            <h5 class="text-gray-900">
                                Pesan dan Saran Ada Disini 🤞
                            </h5>
                            <input
                                type="text"
                                v-model="searchQuery"
                                @keyup.enter="handleSearchInput"
                                placeholder="Cari Pengirim Pesan Disini"
                                class="ml-4 p-2 border border-Dark rounded min-w-[300px] focus:ring-Dark focus:border-Dark"
                            />
                        </div>
                        <div class="w-full border-t border-Dark mt-4"></div>
                        <div class="p-6 text-Dark">
                            <div
                                class="flex justify-between items-center mb-10"
                            >
                                <InputLabel class="mr-2">
                                    Total Data Pesan: {{ kontak.total }}
                                </InputLabel>
                            </div>
                            <div class="w-full">
                                <div
                                    class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3"
                                >
                                    <div
                                        v-for="(
                                            kontakItem, index
                                        ) in displayedKontak"
                                        :key="kontakItem.id"
                                        class="bg-gray-100 rounded-lg overflow-hidden shadow-lg transition-transform transform card-zoom"
                                    >
                                        <div class="p-6">
                                            <h3
                                                class="text-xl font-semibold text-Dark"
                                            >
                                                {{ kontakItem.name }}
                                            </h3>
                                            <p class="text-gray-600 mt-2">
                                                {{ kontakItem.institution }}
                                            </p>
                                            <p class="text-gray-600 mt-2">
                                                {{ kontakItem.email }}
                                            </p>
                                            <p class="text-gray-600 mt-2 mb-5">
                                                {{
                                                    truncateDescription(
                                                        kontakItem.message,
                                                        40
                                                    )
                                                }}
                                            </p>
                                            <p class="text-gray-600 mt-2 mb-5">
                                                {{
                                                    formatDate(
                                                        kontakItem.created_at
                                                    )
                                                }}
                                            </p>
                                            <div
                                                class="justify-end text-end px-6 py-4 flex space-x-2"
                                            >
                                                <Link
                                                    :href="
                                                        route('pesan.detail', {
                                                            id: kontakItem.id,
                                                        })
                                                    "
                                                    class="bg-Dark hover:text-Hijau text-white font-base py-2 px-4 rounded m-2"
                                                >
                                                    Detail
                                                </Link>
                                                <button
                                                    @click="
                                                        confirmDelete(
                                                            kontakItem
                                                        )
                                                    "
                                                    class="bg-Dark py-2 hover:text-Hijau text-white font-base px-4 rounded m-2"
                                                >
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between mt-10">
                                    <button
                                        @click="prevPage"
                                        :disabled="!kontak.prev_page_url"
                                        class="bg-Dark text-white py-2 px-4 rounded"
                                    >
                                        Previous
                                    </button>
                                    <button
                                        @click="nextPage"
                                        :disabled="!kontak.next_page_url"
                                        class="bg-Dark text-white py-2 px-4 rounded"
                                    >
                                        Next
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div
                                v-if="dialogDelete"
                                class="fixed z-10 inset-0 overflow-y-auto"
                            >
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
                                                    Hapus Pesan
                                                </h3>
                                                <div class="mt-2">
                                                    <p
                                                        class="text-sm leading-5 text-Dark"
                                                    >
                                                        Apakah Kamu Yakin Ingin
                                                        Menghapus Data Ini?
                                                        Tindakan Ini Tidak Bisa
                                                        Dikembalikan.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse"
                                        >
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
import { format } from "date-fns"; // Import fungsi format dari date-fns
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue"; // Pastikan path sudah benar

const props = defineProps({
    kontak: Object,
});
const searchQuery = ref("");
let dialogDelete = ref(false); // Gunakan ref untuk variabel reactive
let itemDelete = ref(null); // Gunakan ref untuk variabel reactive
// Fungsi untuk menampilkan konfirmasi hapus
const confirmDelete = (kontakItem) => {
    itemDelete.value = kontakItem; // Menggunakan langsung
    dialogDelete.value = true; // Menggunakan langsung
};

const hapus = (kontakItem) => {
    deleteKontak(kontakItem.id); // Menggunakan KontakItem.id karena sudah sesuai
};

// Fungsi untuk menghapus data Kontak dengan HTTP DELETE
const deleteKontak = (kontakId) => {
    Inertia.delete(route("kontak.delete", { id: kontakId })).then(() => {
        Inertia.reload();
    });
    closeDelete();
};

const closeDelete = () => {
    dialogDelete.value = false;
    itemDelete.value = null;
};
const prevPage = () => {
    if (props.kontak.prev_page_url) {
        Inertia.visit(props.kontak.prev_page_url);
    }
};

const nextPage = () => {
    if (props.kontak.next_page_url) {
        Inertia.visit(props.kontak.next_page_url);
    }
};

const displayedKontak = computed(() => {
    if (searchQuery.value.trim() === "") {
        return props.kontak.data;
    } else {
        return props.kontak.data.filter((kontak) =>
            kontak.name.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    }
});

const handleSearchInput = () => {
    if (searchQuery.value.trim() === "") {
        Inertia.visit(route("pesan"));
    } else {
        Inertia.get(
            route("pesan"),
            { search: searchQuery.value },
            {
                preserveState: true,
                replace: true,
            }
        );
    }
};

const truncateDescription = (text, length) => {
    if (text.length > length) {
        return text.substring(0, length) + "...";
    }
    return text;
};

// Fungsi untuk memformat tanggal
const formatDate = (dateString) => {
    return format(new Date(dateString), "yyyy-MM-dd HH:mm:ss");
};
</script>

<style>
/* Gaya CSS sesuai kebutuhan */
.transition-transform {
    transition: transform 0.3s ease-in-out;
}

.transition-opacity {
    transition: opacity 0.3s ease-in-out;
}

.card-zoom {
    transition: transform 0.3s ease-in-out;
}

.card-zoom:hover {
    transform: scale(1.05);
}
</style>
