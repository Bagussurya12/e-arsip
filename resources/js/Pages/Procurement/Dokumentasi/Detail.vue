<template>
    <Head title="Detail Dokumentasi" />
    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Detail Dokumentasi
            </h3>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row">
                    <!-- DOKUMEN VIEW -->
                    <div class="w-full md:w-1/2 self-center px-4 mb-4 md:mb-0">
                        <iframe
                            :src="`/storage/${dokumentasi.foto}`"
                            width="100%"
                            height="600px"
                            style="border: none"
                            class="w-full h-[800px] border-none rounded-md"
                        ></iframe>
                    </div>
                    <!-- KETERANGAN DOKUMEN -->
                    <div class="w-full md:w-1/2 self-start px-4 mt-10">
                        <div class="flex mb-4">
                            <strong class="w-1/3">Judul</strong>
                            <span class="w-2/3">: {{ dokumentasi.title }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Deskripsi</strong>
                            <span class="w-2/3">: {{ dokumentasi.deskripsi }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Tanggal</strong>
                            <span class="w-2/3">: {{ formatDate(dokumentasi.tanggal) }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Dibuat/Diubah Oleh:</strong>
                            <span class="w-2/3">: {{ user_name }} || {{ formatDate(dokumentasi.updated_at) }}</span>
                        </div>
                        <div class="flex mt-20">
                            <a
                                :href="`/storage/${dokumentasi.foto}`"
                                target="_blank"
                                class="bg-Dark text-white font-bold py-2 px-4 rounded mr-4 hover:bg-Hijau"
                            >
                                Lihat Dokumentasi
                            </a>
                            <a
                                :href="`/storage/${dokumentasi.foto}`"
                                download
                                class="bg-Hijau text-white font-bold py-2 px-4 rounded hover:bg-Dark"
                            >
                                Unduh Dokumentasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { format } from "date-fns";

const props = defineProps({
    dokumentasi: Object,
    user_name : String
});

const formatDate = (date) => {
    return format(new Date(date), "yyyy-MM-dd");
};
</script>
