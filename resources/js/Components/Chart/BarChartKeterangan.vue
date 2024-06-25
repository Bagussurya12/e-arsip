<template>
    <div>
        <Bar :data="chartData" :options="chartOptions"></Bar>
    </div>
</template>

<script>
import { Bar } from "vue-chartjs";
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
    },
    props: {
        suratMasuk: Number,
        suratKeluar: Number,
    },
    computed: {
        chartData() {
            return {
                labels: ["Surat Masuk", "Surat Keluar"],
                datasets: [
                    {
                        label: "Jumlah Surat",
                        backgroundColor: ["#42A5F5", "#66BB6A"],
                        data: [this.suratMasuk, this.suratKeluar],
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
div {
    height: 400px;
}
</style>
