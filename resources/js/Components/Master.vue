<template>
    <section id="master" class="relative w-full overflow-hidden">
        <div class="m-0 p-0 w-full h-full flex relative">
            <img
                ref="masterImage"
                src="../../../assets/img/monas.png"
                alt="Master Image"
                class="m-0 p-0 w-full lg:h-[600px] sm:h-full object-cover zoom-effect"
            />
            <!-- Overlay -->
            <div
                class="absolute top-0 left-0 w-full h-full bg-black opacity-50"
            ></div>
            <!-- Text Content -->
            <div
                class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-white"
            >
                <div class="text-center">
                    <h1 class="text-4xl md:text-8xl font-bold">OCBD</h1>
                    <h3 class="text-xl md:text-2xl mb-4 font-serif">
                        A Metropolis Sanctuary
                    </h3>
                    <p class="text-md md:text-xl max-w-[600px]">
                        One Central Business District (OCBD) is an exclusive
                        business area integrated with residential, business, and
                        commercial zones.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
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

<style>
/* Ensure the navbar height is taken into account */
#master {
    padding-top: 4rem; /* Adjust this value to match the height of your navbar */
}

.zoom-effect {
    transition: transform 0.9s ease;
}
</style>
