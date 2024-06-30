<template>
    <AuthenticatedLayout>
        <Head title="Statistik" />

        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Statistik Arsip
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <BarChartKeterangan
                        :totalSuratMasuk="totalSuratMasuk"
                        :totalSuratKeluar="totalSuratKeluar"
                        :jenisSurat="jenisSurat"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import BarChartKeterangan from "@/Components/Chart/BarChartKeterangan.vue";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        BarChartKeterangan,
    },
    props: {
        totalSuratMasuk: Number,
        totalSuratKeluar: Number,
        jenisSurat: Object,
    },
};
</script>
