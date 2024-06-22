<template>
    <Head title="Detail Pesan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Pesan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-2xl font-bold mb-4">
                            {{ kontak.name }}
                        </h3>
                        <div class="info-row mb-2">
                            <strong>Email</strong>
                            <span>: {{ kontak.email }}</span>
                        </div>
                        <div class="info-row mb-2">
                            <strong>Nomor Telepon</strong>
                            <span>: {{ kontak.phone }}</span>
                        </div>
                        <div class="info-row mb-2">
                            <strong>Institusi</strong>
                            <span>: {{ kontak.institution }}</span>
                        </div>
                        <div class="info-row mb-2">
                            <strong>Dikirim pada</strong>
                            <span>: {{ formatDate(kontak.created_at) }}</span>
                        </div>
                        <div class="info-row mb-10">
                            <strong>Pesan</strong>
                            <p>: {{ kontak.message }}</p>
                        </div>

                        <Link
                            :href="route('pesan')"
                            class="bg-Dark hover:text-Hijau text-white font-base py-2 px-4 rounded mt-10"
                        >
                            Kembali ke Daftar Pesan
                        </Link>
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
import { format } from "date-fns"; // Import fungsi format dari date-fns

const props = defineProps({
    kontak: Object,
});

// Fungsi untuk memformat tanggal
const formatDate = (dateString) => {
    return format(new Date(dateString), "yyyy-MM-dd HH:mm:ss");
};
</script>

<style scoped>
.info-row {
    display: flex;
    justify-content: space-between;
}
.info-row strong {
    flex: 1;
}
.info-row span,
.info-row p {
    flex: 2;
    text-align: left;
}
</style>
