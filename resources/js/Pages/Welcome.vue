<template>
    <div>
        <Head title="Home" />
        <Navbar />
        <section id="main" class="relative w-full h-full overflow-hidden">
            <div class="m-0 p-0 w-full h-full flex relative">
                <img
                    ref="mainImage"
                    :src="'/storage/' + foto_tema"
                    alt="Master Image"
                    class="m-0 p-0 w-full h-full object-cover zoom-effect transition-transform"
                />
                <div
                    class="absolute top-0 left-0 w-full h-full bg-black opacity-50"
                ></div>
                <div
                    class="absolute top-0 left-0 w-full h-full flex flex-col items-center justify-center space-y-2 text-center"
                >
                    <h1 class="text-xl text-white font-bold mx-10">
                        E-Arsip Dispusip DKI Jakarta
                    </h1>
                    <h3
                        ref="typewriterText"
                        class="text-4xl text-white font-bold mx-10"
                    >
                        <!-- Tempat teks untuk efek mengetik -->
                    </h3>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navbar from "@/Components/Navbar.vue";
import { defineProps } from "vue";

export default {
    components: {
        Head,
        Navbar,
        Link,
    },
    props: {
        foto_tema: String,
        teks_tema: String,
    },
    mounted() {
        this.typeWriterEffect(this.teks_tema, this.$refs.typewriterText);
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    methods: {
        handleScroll() {
            const image = this.$refs.mainImage;
            const scrollPosition = window.scrollY;
            const scaleFactor = 1 + scrollPosition / 1000;
            image.style.transform = `scale(${scaleFactor})`;
        },
        typeWriterEffect(text, element) {
            let i = 0;
            const speed = 100; // Kecepatan efek mengetik dalam milidetik
            const typeWriter = () => {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, speed);
                }
            };
            typeWriter();
        },
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

.zoom-effect {
    transition: transform 0.3s ease-in-out;
}

@media (min-width: 1024px) {
    .zoom-effect {
        height: 100vh;
    }
}

@media (max-width: 1023px) {
    .zoom-effect {
        height: 100vh;
        width: 100vw;
    }
}
</style>
