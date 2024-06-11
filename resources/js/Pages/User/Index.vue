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
                        Kelola Pengguna untuk menjaga keamanan Akun 🤞
                    </div>
                    <div class="w-full border-t border-slate-700"></div>
                    <div class="p-6 text-black">
                        <div class="flex justify-between items-center mb-10">
                            <label
                                >Total Data Pengguna: {{ users.total }}</label
                            >
                            <Link
                                :href="route('users.create')"
                                class="bg-Dark hover:text-Hijau text-white font-bold py-2 px-4 rounded"
                                >Tambah Pengguna</Link
                            >
                        </div>

                        <table class="min-w-full">
                            <thead class="mb-5">
                                <tr class="border-b-2">
                                    <th
                                        class="px-6 py-3 text-left text-lg font-medium text-black"
                                    >
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-lg font-medium text-black"
                                    >
                                        Id
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-lg font-medium text-black"
                                    >
                                        Nama
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-lg font-medium text-black"
                                    >
                                        Email
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-lg font-medium text-black"
                                    >
                                        Role
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(user, index) in users.data"
                                    :key="user.id"
                                    class="border-b"
                                >
                                    <td class="px-6 py-4">{{ index + 1 }}</td>
                                    <td class="px-6 py-4">{{ user.id }}</td>
                                    <td class="px-6 py-4">{{ user.name }}</td>
                                    <td class="px-6 py-4">{{ user.email }}</td>
                                    <td class="px-6 py-4">{{ user.role }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-10">
                            <button
                                @click="prevPage"
                                :disabled="!users.prev_page_url"
                                class="px-4 py-2 mr-2 bg-Dark text-white rounded"
                            >
                                Previous
                            </button>
                            <button
                                @click="nextPage"
                                :disabled="!users.next_page_url"
                                class="px-4 py-2 bg-Dark text-white rounded"
                            >
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    users: Object,
});

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
</script>
