<template>
    <div
        class="pencarian w-full text-center mt-10 md:mt-24 lg:mt-10 items-center"
    >
        <div class="container mx-auto">
            <div class="w-full py-10 px-5 rounded-lg bg-Biru">
                <form
                    @submit.prevent="submitSearch"
                    class="flex justify-center flex-wrap w-full mx-auto"
                >
                    <!-- Select Naskah Dinas -->
                    <div
                        class="sm:w-full md:w-full lg:w-1/6 sm:mb-2 bg-white text-sm rounded-l-lg border-transparent border-none px-2"
                    >
                        <select
                            id="selectNaskah"
                            name="naskahDinas"
                            v-model="filters.naskahDinas"
                            class="truncate w-full border-none focus:outline-none focus:ring-0"
                        >
                            <option disabled selected value="">
                                Naskah Dinas
                            </option>
                            <option
                                v-for="naskahDinas in NaskahDinasGroup"
                                :key="naskahDinas"
                                :value="naskahDinas"
                                class="text-Dark focus:outline-none"
                            >
                                {{ naskahDinas }}
                            </option>
                        </select>
                    </div>
                    <!-- Input Asal Surat -->
                    <div
                        class="sm:w-full md:w-full lg:w-1/6 sm:mb-2 bg-white text-sm border-transparent"
                    >
                        <input
                            id="inputAsalSurat"
                            type="text"
                            v-model="filters.asalSurat"
                            class="w-full border-none focus:outline-none focus:ring-0 text-Dark"
                            placeholder="Asal Surat"
                        />
                    </div>
                    <!-- Input Uraian Informasi -->
                    <div
                        class="sm:w-full md:w-full lg:w-1/6 sm:mb-2 bg-white text-sm border-transparent"
                    >
                        <input
                            id="inputUraianInformasi"
                            type="text"
                            v-model="filters.uraianInformasi"
                            class="w-full border-none focus:outline-none focus:ring-0 text-Dark"
                            placeholder="Uraian Informasi"
                        />
                    </div>
                    <!-- Input Tanggal -->
                    <div
                        class="sm:w-full md:w-full lg:w-1/12 sm:mb-2 bg-white text-sm border-transparent"
                    >
                        <input
                            id="inputTanggal"
                            type="number"
                            v-model="filters.tanggal"
                            class="w-full border-none focus:outline-none focus:ring-0 text-Dark"
                            placeholder="Tanggal"
                        />
                    </div>
                    <!-- Select Bulan -->
                    <div
                        class="sm:w-full md:w-full lg:w-1/6 sm:mb-2 bg-white text-sm border-transparent"
                    >
                        <select
                            id="bulan"
                            name="optionBulan"
                            v-model="filters.filterBulan"
                            class="truncate w-full border-none focus:outline-none focus:ring-0"
                        >
                            <option disabled selected value="">Bulan</option>
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
                    <!-- Input Tahun -->
                    <div
                        class="sm:w-full md:w-full lg:w-1/12 sm:mb-2 bg-white text-sm rounded-r-lg border-transparent border-none px-2"
                    >
                        <input
                            type="number"
                            v-model="filters.tahun"
                            class="w-full border-none focus:outline-none focus:ring-0 text-Dark"
                            placeholder="Tahun"
                        />
                    </div>
                    <!-- Button Cari -->
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        filters: Object, // Menerima data filter dari komponen induk
    },
    data() {
        return {
            NaskahDinasGroup: [
                "Peraturan Daerah",
                "Peraturan Gubernur",
                "Peraturan Bersama Kepala Daerah",
                "Keputusan Gubernur",
                "Keputusan Kepala Perangkat Daerah",
                "Instruksi",
                "Surat Edaran",
                "Seruan",
                "Surat Perintah",
                "Surat Tugas",
                "Nota Dinas",
                "Nota Kesepakatan",
                "Kesepakatan Bersama",
                "Surat Undangan",
                "Surat Biasa",
                "Surat Panggilan",
                "Telaahan Staf",
                "Laporan",
                "Perjanjian Kerja Sama",
                "Surat Keterangan",
                "Surat Kuasa",
                "Berita Acara",
                "Pengumuman",
                "Surat Pengantar",
                "Surat Perjalanan Dinas",
                "Notulen Rapat",
                "Notulen Rapat Hasil Rapat",
                "Sertifikat",
                "Piagam",
                "Surat Tanda Tamat Pendidikan dan Pelatihan (STTPP)",
                "Memo",
                "Surat Keterangan Melaksanakan Tugas",
                "Rekomendasi",
            ],
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
        submitSearch() {
            this.$emit("search", this.filters); // Mengirim event 'search' dengan data filters ke komponen induk
        },
    },
};
</script>
