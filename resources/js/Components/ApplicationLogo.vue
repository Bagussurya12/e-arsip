<template>
    <div class="slider">
        <img :src="currentImage" alt="Slider Image" />
    </div>
</template>

<script>
export default {
    data() {
        return {
            images: ["/logo.png", "/slogan.png"],
            currentIndex: 0,
        };
    },
    computed: {
        currentImage() {
            return this.images[this.currentIndex];
        },
    },
    mounted() {
        this.startSlider();
    },
    methods: {
        startSlider() {
            setInterval(() => {
                this.currentIndex =
                    (this.currentIndex + 1) % this.images.length;
            }, 120000);
        },
    },
};
</script>

<style scoped>
.slider {
    width: 70px;
    height: auto;
}
img {
    width: 70px;
    height: auto;
    display: block;
}
</style>
