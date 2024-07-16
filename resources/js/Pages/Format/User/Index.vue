<template>
    <Head title="Format Surat" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Format Surat
            </h3>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="p-6 m-6 text-Dark bg-transparent rounded-xl mb-5">
                    <div class="justify-between items-center">
                        Gunakan Format Surat Untuk Mempermudah dalam Membuat dan
                        Mengarsipkan Surat ✨
                    </div>
                </div>
                <!-- Garis horizontal di atas tabel -->
                <div class="w-full border-t border-slate-700"></div>
                <div class="p-6 text-Dark overflow-auto">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="mb-5">
                                <tr class="border-b-2">
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
                                    <td
                                        class="px-4 py-4 text-center self-center border-Dark space-x-2"
                                    >
                                        <a
                                            :href="`/storage/${formatSuratItem.file_surat}`"
                                            download
                                            class="bg-Biru hover:text-Orange text-white font-base py-2 px-4 rounded"
                                        >
                                            Unduh
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    format_surat: {
        type: Array,
        required: true,
    },
});
</script>
