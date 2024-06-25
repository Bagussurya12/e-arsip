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
                    <div class="p-6 text-gray-900">
                        <div
                            class="flex justify-between items-center mb-4"
                        ></div>

                        <form
                            @submit.prevent="fetchStatistics"
                            class="flex justify-center flex-wrap w-full mx-auto"
                        >
                            <div
                                class="w-1/6 bg-white text-sm border-Dark mx-2"
                            >
                                <select
                                    id="bulan"
                                    name="optionBulan"
                                    v-model="month"
                                    class="truncate w-full border-slate-300 rounded-lg focus:outline-none focus:ring-0"
                                >
                                    <option disabled selected value="">
                                        Bulan
                                    </option>
                                    <option
                                        v-for="bulan in optionBulan"
                                        :key="bulan"
                                        :value="bulan"
                                        class="text-Dark focus:outline-none"
                                    >
                                        {{ bulan }}
                                    </option>
                                </select>
                            </div>
                            <!-- Select Tahun -->
                            <div
                                class="w-1/6 bg-white text-sm border-transparent mx-2"
                            >
                                <TextInput
                                    type="number"
                                    v-model="year"
                                    class="w-full focus:outline-none rounded-lg focus:ring-0"
                                    placeholder="Tahun"
                                />
                            </div>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-Hijau text-white rounded ml-2"
                            >
                                Cari
                            </button>
                        </form>

                        <div>
                            <h2 class="mb-2 font-bold">
                                Surat Masuk : {{ totalSuratMasuk }}
                            </h2>
                            <h2 class="mb-2 font-bold">
                                Surat Keluar : {{ totalSuratKeluar }}
                            </h2>
                            <BarChart
                                :suratMasuk="totalSuratMasuk"
                                :suratKeluar="totalSuratKeluar"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import BarChart from "@/Components/Chart/BarChartKeterangan.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        BarChart,
        TextInput,
    },
    props: {
        totalSuratMasuk: Number,
        totalSuratKeluar: Number,
        month: String,
        year: Number,
    },
    data() {
        return {
            month: this.month || "",
            year: this.year || null,
            optionBulan: [
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
            ],
        };
    },
    methods: {
        fetchStatistics() {
            this.$inertia.get(this.route("statistic.keterangan"), {
                month: this.month,
                year: this.year,
            });
        },
    },
};
</script>
