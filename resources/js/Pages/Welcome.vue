<template>
    <div>
        <Head title="Beranda" />
        <Navbar />
        <section
            id="master"
            class="relative w-full h-full overflow-hidden pb-32"
        >
            <div class="m-0 p-0 w-full h-full flex relative">
                <img
                    ref="masterImage"
                    src="../../../assets/img/monas.png"
                    alt="Master Image"
                    class="m-0 p-0 w-full lg:h-[500px] h-full object-cover zoom-effect"
                />
                <div
                    class="absolute top-0 left-0 w-full h-full bg-black opacity-50"
                ></div>

                <div
                    class="absolute top-0 left-0 w-full h-full flex items-center justify-center"
                >
                    <SearchDocument class="rounded-lg"></SearchDocument>
                </div>
            </div>
        </section>
        <Footer></Footer>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3"; // Pastikan ini adalah paket yang benar
import Navbar from "@/Components/Navbar.vue";
import SearchDocument from "@/Components/SearchDocument.vue";
import Footer from "@/Components/Footer.vue";

export default {
    components: {
        Head,
        Navbar,
        SearchDocument,
        Footer,
    },
    mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    methods: {
        handleScroll() {
            const scrollTop = window.scrollY || window.pageYOffset;
            const zoomFactor = 1 + scrollTop / 1000; // Adjust the zoom factor as needed
            this.$refs.masterImage.style.transform = `scale(${zoomFactor})`;
        },
    },
};
</script>
