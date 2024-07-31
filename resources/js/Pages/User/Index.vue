<template>
    <Head title="Pengguna" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Kelola Pengguna
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center">
                            <h5 class="text-gray-900">
                                Kelola Pengguna untuk menjaga keamanan Akun 🤞
                            </h5>
                            <input
                                type="text"
                                v-model="searchQuery"
                                @input="searchUsers"
                                @keyup.enter="handleSearchInput"
                                placeholder="Cari Pengguna disini"
                                class="ml-4 p-2 border border-Dark rounded min-w-[200px] focus:ring-black"
                            />
                        </div>
                    </div>
                    <div class="w-full border-t border-slate-700"></div>
                    <div class="p-6 text-black">
                        <div class="flex justify-between items-center mb-10">
                            <div class="flex items-center">
                                <label class="mr-2">
                                    Total Data Pengguna: {{ users.total }}
                                </label>
                            </div>
                            <Link
                                :href="route('users.create')"
                                class="bg-Orange hover:bg-Biru text-white font-bold py-2 px-4 rounded"
                            >
                                Tambah Pengguna
                            </Link>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="mb-5">
                                    <tr class="border-b-2">
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-black"
                                        >
                                            No
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-black"
                                        >
                                            Id
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-black"
                                        >
                                            Nama
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-black"
                                        >
                                            Email
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-black"
                                        >
                                            Role
                                        </th>
                                        <th
                                            class="px-6 py-3 text-center text-lg font-medium text-black"
                                        >
                                            #
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(user, index) in displayedUsers"
                                        :key="user.id"
                                        class="border-b"
                                    >
                                        <td class="px-6 py-4 text-center">
                                            {{
                                                (props.users.current_page - 1) *
                                                    props.users.per_page +
                                                index +
                                                1
                                            }}
                                        </td>
                                        <td class="px-6 py-4">{{ user.id }}</td>
                                        <td class="px-6 py-4">
                                            {{ user.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ user.email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ user.role }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div
                                                class="flex justify-center space-x-2"
                                            >
                                                <Link
                                                    :href="
                                                        route(
                                                            'users.edit',
                                                            user.id
                                                        )
                                                    "
                                                    class="bg-Biru hover:text-Orange text-white font-base py-2 px-6 rounded"
                                                >
                                                    Edit
                                                </Link>
                                                <button
                                                    @click="
                                                        confirmDelete(user.id)
                                                    "
                                                    class="bg-Orange hover:text-Biru text-white font-base py-2 px-4 rounded"
                                                >
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-10">
                            <button
                                @click="prevPage"
                                :disabled="!users.prev_page_url"
                                class="px-4 py-2 mr-2 bg-Orange text-white rounded"
                            >
                                Previous
                            </button>
                            <button
                                @click="nextPage"
                                :disabled="!users.next_page_url"
                                class="px-4 py-2 bg-Orange text-white rounded"
                            >
                                Next
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
                                    Hapus Data Pengguna
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
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    users: Object,
});
let dialogDelete = ref(false); // Gunakan ref untuk variabel reactive
let itemDelete = ref(null); // Gunakan ref untuk variabel reactive

const confirmDelete = (user) => {
    itemDelete.value = user; // Menggunakan langsung
    dialogDelete.value = true; // Menggunakan langsung
};
const hapus = (user) => {
    deleteArsip(user); // Menggunakan arsipItem.id karena sudah sesuai
};

const deleteArsip = (userId) => {
    Inertia.delete(route("users.delete", userId))
        .then(() => {
            Inertia.reload();
        })
        .catch((error) => {
            console.error("Error deleting user:", error);
        });
    closeDelete();
};

const closeDelete = () => {
    dialogDelete.value = false;
    itemDelete.value = null;
};

const searchQuery = ref("");

// Mengelola navigasi halaman
const prevPage = () => {
    if (props.users.prev_page_url) {
        Inertia.visit(props.users.prev_page_url);
    }
};

const nextPage = () => {
    if (props.users.next_page_url) {
        Inertia.visit(props.users.next_page_url);
    }
};

const displayedUsers = computed(() => {
    if (searchQuery.value.trim() === "") {
        // Jika query kosong, tampilkan semua data pengguna
        return props.users.data;
    } else {
        // Jika query tidak kosong, filter data pengguna sesuai dengan query
        return props.users.data.filter((user) =>
            user.name.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    }
});

// Fungsi untuk pencarian
const searchUsers = () => {
    if (searchQuery.value.trim() === "") {
        // Jika query kosong, arahkan pengguna kembali ke halaman semula
        Inertia.visit(route("users"));
    } else {
        Inertia.get(
            route("users"),
            { search: searchQuery.value },
            {
                preserveState: true,
                replace: true,
            }
        );
    }
};

// Event listener untuk mendeteksi tekanan tombol "Enter"
const handleSearchInput = (event) => {
    if (event.key === "Enter" && searchQuery.value.trim() === "") {
        // Jika tombol "Enter" ditekan dan nilai pencarian kosong,
        // arahkan pengguna kembali ke halaman semula
        Inertia.visit(route("users"));
    }
};
</script>
