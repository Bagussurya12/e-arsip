<template>
    <div>
        <Head title="Beranda" />
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
                    class="absolute top-0 left-0 w-full h-full flex items-center justify-center"
                >
                    <h1 class="text-4xl text-white font-bold mx-10">
                        Data Arsip
                    </h1>
                </div>
            </div>
        </section>
        <!-- DATA ARSIP -->

        <section
            id="Arsip"
            class="pt-20 pb-20 bg-white"
            v-if="arsip && arsip.data"
        >
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <SearchDocument
                        :filters="searchFilters"
                        @search="handleSearch"
                    ></SearchDocument>
                </div>
                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="(arsipItem, index) in displayedArsip"
                        :key="arsipItem.id"
                        class="bg-gray-100 rounded-lg overflow-hidden shadow-lg transition-transform transform card-zoom"
                    >
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-Dark">
                                {{ arsipItem.jenis_arsip }}
                            </h3>
                            <p class="text-gray-600 mt-2">
                                {{ arsipItem.asal_surat }}
                            </p>
                            <p class="text-gray-600 mt-2 mb-5">
                                {{
                                    truncateDescription(
                                        arsipItem.uraian_informasi,
                                        40
                                    )
                                }}
                            </p>
                            <p class="text-gray-600 mt-2 mb-5">
                                {{ arsipItem.tanggal_surat }} ||
                                {{ arsipItem.keterangan }} ||
                                {{ arsipItem.jenis_media }}
                            </p>
                            <div class="justify-end text-end">
                                <Link
                                    :href="
                                        route('detail.arsip', {
                                            id: arsipItem.id,
                                        })
                                    "
                                    class="bg-Orange hover:text-Biru text-white font-base py-2 px-4 rounded"
                                >
                                    Detail
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <Footer></Footer>
    </div>
</template>

<script>
import { ref, computed } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import SearchDocument from "@/Components/SearchDocument.vue";

export default {
    components: {
        Head,
        Navbar,
        Footer,
        SearchDocument,
        Link,
    },
    props: {
        arsip: Object,
    },
    data() {
        return {
            searchFilters: {
                naskahDinas: "",
                uraianInformasi: "",
                filterBulan: "",
                tahun: "",
                filterMediaArsip: "",
            },
        };
    },
    mounted() {
        if (this.arsip) {
            console.log(this.arsip.data);
        }
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    methods: {
        handleScroll() {
            const scrollTop = window.scrollY || window.pageYOffset;
            const zoomFactor = 1 + scrollTop / 1000;
            this.$refs.masterImage.style.transform = `scale(${zoomFactor})`;
        },
        truncateDescription(text, maxLength) {
            if (text.length <= maxLength) {
                return text;
            }
            return text.substring(0, maxLength) + "...";
        },
        handleSearch(filters) {
            this.searchFilters = filters;
        },
    },
    setup(props) {
        const searchQuery = ref("");
        const searchFilters = ref({
            naskahDinas: "",
            filterBulan: "",
            tahun: "",
            filterMediaArsip: "",
        });

        const displayedArsip = computed(() => {
            if (
                searchQuery.value.trim() === "" &&
                searchFilters.value.naskahDinas === "" &&
                searchFilters.value.filterBulan === "" &&
                searchFilters.value.tahun === "" &&
                searchFilters.value.filterMediaArsip === ""
            ) {
                return props.arsip && props.arsip.data ? props.arsip.data : [];
            } else {
                return props.arsip && props.arsip.data
                    ? props.arsip.data.filter((arsip) => {
                          const filterNaskahDinas =
                              !searchFilters.value.naskahDinas ||
                              arsip.jenis_arsip.toLowerCase() ===
                                  searchFilters.value.naskahDinas.toLowerCase();

                          const filterUraian =
                              searchQuery.value.trim() === "" ||
                              arsip.uraian_informasi
                                  .toLowerCase()
                                  .includes(searchQuery.value.toLowerCase());

                          const filterBulan =
                              !searchFilters.value.filterBulan ||
                              arsip.lokasi_simpan.map_bulan.toLowerCase() ===
                                  searchFilters.value.filterBulan.toLowerCase();

                          const filterTahun =
                              searchFilters.value.tahun === "" ||
                              arsip.lokasi_simpan.tahun ===
                                  searchFilters.value.tahun;

                          const filterMediaArsip =
                              !searchFilters.value.filterMediaArsip ||
                              arsip.jenis_media.toLowerCase() ===
                                  searchFilters.value.filterMediaArsip.toLowerCase();

                          return (
                              filterNaskahDinas &&
                              filterUraian &&
                              filterBulan &&
                              filterTahun &&
                              filterMediaArsip
                          );
                      })
                    : [];
            }
        });

        return {
            displayedArsip,
            searchQuery,
            searchFilters,
        };
    },
};
</script>

<style>
/* Gaya CSS sesuai kebutuhan */
.transition-transform {
    transition: transform 0.3s ease-in-out;
}

.transition-opacity {
    transition: opacity 0.3s ease-in-out;
}

.card-zoom {
    transition: transform 0.3s ease-in-out;
}

.card-zoom:hover {
    transform: scale(1.05);
}
</style>
