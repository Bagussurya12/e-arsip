<template>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                            class="px-6 py-2 bg-Biru text-white rounded ml-2 hover:bg-Orange"
                        >
                            Cari
                        </button>
                    </form>
                    <h2 class="mb-2 font-bold">
                        Surat Masuk : {{ totalSuratMasuk }}
                    </h2>
                    <h2 class="mb-2 font-bold">
                        Surat Keluar : {{ totalSuratKeluar }}
                    </h2>
                    <div class="sm:flex sm:space-x-6">
                        <!-- Chart Surat Masuk dan Surat Keluar -->
                        <div class="sm:w-1/2 mb-4 sm:mb-0">
                            <div class="chart-container">
                                <Bar
                                    :data="chartData"
                                    :options="chartOptions"
                                ></Bar>
                            </div>
                        </div>
                        <!-- Chart Jenis Surat -->
                        <div class="sm:w-1/2">
                            <div class="chart-container mt-4">
                                <Line
                                    :data="chartDataJenisSurat"
                                    :options="chartOptions"
                                ></Line>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Bar, Line } from "vue-chartjs";
import TextInput from "@/Components/TextInput.vue";
import {
    Chart as ChartJS,
    BarElement,
    LineElement,
    CategoryScale,
    LinearScale,
    Tooltip,
    Legend,
    PointElement,
} from "chart.js";

ChartJS.register(
    BarElement,
    LineElement,
    CategoryScale,
    LinearScale,
    Tooltip,
    Legend,
    PointElement
);

export default {
    components: {
        Bar,
        Line,
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
            const colors = ["#1A237E"];

            return {
                labels: labels,
                datasets: [
                    {
                        label: "Jumlah Surat per Jenis",
                        borderColor: colors.slice(0, labels.length),
                        data: data,
                        fill: false,
                    },
                ],
            };
        },
        chartOptions() {
            return {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        },
                    },
                },
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
