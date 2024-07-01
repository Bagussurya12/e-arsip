<template>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4"></div>

                    <form
                        @submit.prevent="fetchStatistics"
                        class="flex justify-center flex-wrap w-full mx-auto"
                    >
                        <div class="w-1/6 bg-white text-sm border-Dark mx-2">
                            <select
                                id="bulan"
                                name="optionBulan"
                                v-model="bulan"
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
                                v-model="tahun"
                                class="w-full focus:outline-none rounded-lg focus:ring-0"
                                placeholder="Tahun"
                            />
                        </div>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-Biru text-white rounded ml-2"
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
                        <div class="chart-container">
                            <Bar
                                :data="chartData"
                                :options="chartOptions"
                            ></Bar>
                        </div>
                        <div class="chart-container mt-4">
                            <Bar
                                :data="chartDataJenisSurat"
                                :options="chartOptions"
                            ></Bar>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Bar } from "vue-chartjs";
import { Doughnut } from "vue-chartjs";
import TextInput from "@/Components/TextInput.vue";
import {
    Chart as ChartJS,
    BarElement,
    CategoryScale,
    LinearScale,
    Tooltip,
    Legend,
} from "chart.js";

ChartJS.register(BarElement, CategoryScale, LinearScale, Tooltip, Legend);

export default {
    components: {
        Bar,
        TextInput,
    },
    props: {
        totalSuratMasuk: Number,
        totalSuratKeluar: Number,
        jenisSurat: {
            type: Object,
            required: true,
            default: () => ({}),
        },
    },
    data() {
        return {
            bulan: "",
            tahun: null,
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
            this.$inertia.get(this.route("statistic.page"), {
                bulan: this.bulan,
                tahun: this.tahun,
            });
        },
    },
    computed: {
        chartData() {
            return {
                labels: ["Surat Masuk", "Surat Keluar"],
                datasets: [
                    {
                        label: "Jumlah Surat",
                        backgroundColor: ["#42A5F5", "#66BB6A"],
                        data: [this.totalSuratMasuk, this.totalSuratKeluar],
                    },
                ],
            };
        },
        chartDataJenisSurat() {
            const labels = Object.keys(this.jenisSurat);
            const data = Object.values(this.jenisSurat);
            const colors = [
                "#1A237E",
                "#004D40",
                "#311B92",
                "#1B5E20",
                "#880E4F",
                "#1A237E",
                "#004D40",
                "#311B92",
                "#1B5E20",
                "#880E4F",
                "#1A237E",
                "#004D40",
                "#311B92",
                "#1B5E20",
                "#880E4F",
                "#1A237E",
                "#004D40",
                "#311B92",
                "#1B5E20",
                "#880E4F",
                "#1A237E",
                "#004D40",
                "#311B92",
                "#1B5E20",
                "#880E4F",
                "#1A237E",
                "#004D40",
                "#311B92",
                "#1B5E20",
                "#880E4F",
                "#1A237E",
                "#004D40",
                "#311B92",
                "#1B5E20",
                "#880E4F",
            ];

            return {
                labels: labels,
                datasets: [
                    {
                        label: "Jumlah Surat per Jenis",
                        backgroundColor: colors.slice(0, labels.length),
                        data: data,
                    },
                ],
            };
        },
        chartOptions() {
            return {
                responsive: true,
                maintainAspectRatio: false,
            };
        },
    },
};
</script>

<style scoped>
.chart-container {
    height: 400px;
    width: 100%;
}
</style>
