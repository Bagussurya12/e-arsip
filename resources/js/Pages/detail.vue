<template>
    <section>
        <Head title="Detail Arsip" />
        <Navbar />
        <section id="master" class="relative w-full h-full overflow-hidden">
            <div class="m-0 p-0 w-full h-full flex relative">
                <img
                    ref="masterImage"
                    src="../../../assets/img/monas.png"
                    alt="Master Image"
                    class="m-0 p-0 w-full lg:h-[400px] h-full object-cover zoom-effect"
                />
                <div
                    class="absolute top-0 left-0 w-full h-full bg-black opacity-50"
                ></div>

                <div
                    class="absolute top-0 left-0 w-full h-full flex justify-start pt-48"
                >
                    <div class="mx-auto">
                        <h1 class="text-xl text-white font-bold mx-10">
                            {{ arsip.asal_surat }} || {{ arsip.nomor_dokumen }}
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="details" class="pt-36 pb-32">
            <div class="container mx-auto">
                <div class="flex flex-col md:flex-row">
                    <!-- DOKUMEN VIEW -->
                    <div class="w-full md:w-1/2 self-center px-4 mb-4 md:mb-0">
                        <iframe
                            :src="`/storage/${arsip.media}`"
                            width="100%"
                            height="600px"
                            style="border: none"
                            class="w-full h-[600px] border-none rounded-md"
                        ></iframe>
                    </div>
                    <!-- KETERANGAN DOKUMEN -->
                    <div class="w-full md:w-1/2 self-start px-4 mt-10">
                        <div class="flex mb-4">
                            <strong class="w-1/3">Naskah Dinas</strong>
                            <span class="w-2/3">: {{ arsip.jenis_arsip }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Asal Surat</strong>
                            <span class="w-2/3">: {{ arsip.asal_surat }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Nomor Dokumen</strong>
                            <span class="w-2/3"
                                >: {{ arsip.nomor_dokumen }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Jenis Arsip</strong>
                            <span class="w-2/3">: {{ arsip.jenis_arsip }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Tanggal Surat</strong>
                            <span class="w-2/3"
                                >: {{ arsip.tanggal_surat }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Uraian Informasi</strong>
                            <span class="w-2/3"
                                >: {{ arsip.uraian_informasi }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Keterangan</strong>
                            <span class="w-2/3">: {{ arsip.keterangan }}</span>
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Tingkat Perkembangan</strong>
                            <span class="w-2/3"
                                >: {{ arsip.tingkat_perkembangan }}</span
                            >
                        </div>
                        <div class="flex mb-4">
                            <strong class="w-1/3">Jenis Media</strong>
                            <span class="w-2/3">: {{ arsip.jenis_media }}</span>
                        </div>
                        <div class="flex mt-20">
                            <button
                                class="bg-Dark text-white font-bold py-2 px-4 rounded mr-4 hover:bg-blue-700"
                                @click="viewDocument"
                            >
                                Lihat Dokumen
                            </button>
                            <a
                                :href="`/storage/${arsip.media}`"
                                download
                                class="bg-Hijau text-white font-bold py-2 px-4 rounded hover:bg-green-700"
                            >
                                Unduh Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Footer></Footer>
    </section>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";

export default {
    components: {
        Head,
        Navbar,
        Footer,
    },
    props: {
        arsip: {
            type: Object,
            required: true,
        },
    },
    methods: {
        viewDocument() {
            window.open(`/storage/${this.arsip.media}`, "_blank");
        },
    },
};
</script>

<style>
/* Tambahkan gaya CSS sesuai kebutuhan */
.zoom-effect {
    transition: transform 0.3s ease-in-out;
}
</style>
