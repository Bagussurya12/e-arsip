<template>
    <div
        class="pencarian w-full text-center mt-10 md:mt-10 lg:mt-10 items-center"
    >
        <div class="container mx-auto">
            <div class="w-full py-5 px-5 rounded-lg bg-Biru">
                <form
                    @submit.prevent="submitSearch"
                    class="flex justify-center flex-wrap w-full mx-auto"
                >
                    <!-- Select Naskah Dinas -->
                    <div
                        class="w-full md:w-full lg:w-1/6 bg-white text-sm rounded-l-lg border-transparent border-0 mb-5 sm:px-2"
                    >
                        <select
                            id="selectNaskah"
                            name="naskahDinas"
                            v-model="filters.naskahDinas"
                            class="truncate w-full border-0 text-Dark focus:outline-none focus:ring-0"
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
                        class="w-full md:w-full lg:w-1/6 bg-white text-sm sm:rounded-lg md:rounded-lg border-transparent border-none mb-5"
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
                        class="w-full md:w-full lg:w-1/6 bg-white text-sm sm:rounded-lg md:rounded-lg border-transparent border-none mb-5"
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
                        class="w-full md:w-full lg:w-1/12 bg-white text-sm sm:rounded-lg md:rounded-lg border-transparent border-none mb-5"
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
                        class="w-full md:w-full lg:w-1/6 bg-white text-sm sm:rounded-lg md:rounded-lg border-transparent mb-5"
                    >
                        <select
                            id="bulan"
                            name="optionBulan"
                            v-model="filters.bulan"
                            class="truncate w-full border-none focus:outline-none focus:ring-0 text-Dark"
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
                        class="w-full md:w-full lg:w-1/12 bg-white text-sm rounded-r-lg border-transparent border-none px-2 mb-5"
                    >
                        <input
                            type="number"
                            v-model="filters.tahun"
                            class="w-full border-none focus:outline-none focus:ring-0 text-Dark"
                            placeholder="Tahun"
                        />
                    </div>

                    <div
                        class="w-full md:w-full lg:w-1/12 lg:mx-5 p-2 px-5 bg-Orange text-sm rounded-lg border-transparent border-none mb-5"
                    >
                        <button
                            type="submit"
                            class="text-base hover:text-Dark hover:font-bold"
                        >
                            Cari
                        </button>
                    </div>
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
                "Surat Permohonan",
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
            this.$inertia.get(route("arsip"), this.filters, {
                preserveState: true,
                preserveScroll: true,
            });
        },
    },
};
</script>
