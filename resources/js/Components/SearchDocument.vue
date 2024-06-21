<template>
    <div
        class="pencarian w-full text-center mt-16 md:mt-24 lg:mt-32 items-center"
    >
        <div class="container mx-auto">
            <form
                action=""
                class="flex justify-center flex-wrap w-full mx-auto"
            >
                <!-- Select Naskah Dinas -->
                <div
                    class="w-1/6 bg-white text-sm rounded-l-lg border-transparent border-none px-2"
                >
                    <select
                        id="selectNaskah"
                        name="naskahDinas"
                        class="truncate w-full border-none focus:outline-none focus:ring-0"
                    >
                        <option disabled selected>Naskah Dinas</option>
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
                <!-- Input Nomor Naskah Dinas -->
                <div class="w-1/6 bg-white text-sm border-transparent">
                    <input
                        id="inputNomor"
                        type="text"
                        class="w-full border-none focus:outline-none focus:ring-0"
                        placeholder="Uraian Informasi"
                    />
                </div>
                <!-- Select Bulan -->
                <div class="w-1/6 bg-white text-sm border-transparent">
                    <select
                        id="bulan"
                        name="optionBulan"
                        class="truncate w-full border-none focus:outline-none focus:ring-0"
                    >
                        <option disabled selected>Bulan</option>
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
                <div class="w-1/6 bg-white text-sm border-transparent">
                    <input
                        type="number"
                        class="w-full border-none focus:outline-none focus:ring-0"
                        placeholder="Tahun"
                    />
                </div>
                <!-- Select Media Arsip -->
                <div
                    class="w-1/6 bg-white text-sm border-transparent border-none px-2"
                >
                    <select
                        id="selectMedia"
                        name="mediaArsip"
                        class="truncate w-full border-none focus:outline-none focus:ring-0"
                    >
                        <option disabled selected>Media Arsip</option>
                        <option
                            v-for="mediaArsip in MediaArsipGroup"
                            :key="mediaArsip"
                            :value="mediaArsip"
                            class="text-Dark rounded-lg"
                        >
                            {{ mediaArsip }}
                        </option>
                    </select>
                </div>
                <!-- Button Cari -->
                <div
                    class="w-auto bg-white text-sm rounded-r-lg border-transparent border-none px-2"
                >
                    <button
                        type="submit"
                        class="flex items-center justify-center h-full px-3 py-2 w-10 text-Dark rounded-lg focus:outline-none"
                    >
                        <svg
                            role="img"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <title>Cari</title>
                            <path
                                d="m13.716 17.261 6.873 6.582L24 20.282l-6.824-6.536a9.11 9.11 0 0 0 1.143-4.43c0-5.055-4.105-9.159-9.16-9.159S0 4.261 0 9.316c0 5.055 4.104 9.159 9.159 9.159a9.11 9.11 0 0 0 4.557-1.214ZM9.159 2.773a6.546 6.546 0 0 1 6.543 6.543 6.545 6.545 0 0 1-6.543 6.542 6.545 6.545 0 0 1-6.542-6.542 6.545 6.545 0 0 1 6.542-6.543ZM7.26 5.713a4.065 4.065 0 0 1 4.744.747 4.064 4.064 0 0 1 .707 4.749l1.157.611a5.376 5.376 0 0 0-.935-6.282 5.377 5.377 0 0 0-6.274-.987l.601 1.162Z"
                            />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            NaskahDinasGroup: [
                "Instruksi",
                "Surat Perintah",
                "Surat Keterangan",
                "Surat Biasa",
                "Surat Perintah Tugas",
                "Surat Tugas",
                "Surat Kuasa",
                "Surat Undangan",
                "Surat Edaran",
                "Surat Keputusan",
                "Surat Perjanjian",
                "Surat Laporan",
                "Nota Dinas",
                "Nota Pengajuan Naskah Dinas",
                "Telaahan Staf",
                "Lain-lain",
            ],
            MediaArsipGroup: ["PDF", "Gambar", "Vidio", "Audio", "Lain-lain"],
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
};
</script>

<style>
select:focus,
input:focus {
    outline: none !important;
    box-shadow: none !important;
}
</style>
