<template>
    <section>
        <Head title="Kontak" />
        <Navbar />
        <section>
            <section id="detail" class="relative w-full h-full overflow-hidden">
                <div class="m-0 p-0 w-full h-full flex relative">
                    <img
                        ref="masterImage"
                        :src="'/storage/' + foto_tema"
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
                            <h1 class="text-4xl text-white font-bold mx-10">
                                Hubungi Kami
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pt-24 flex justify-center">
                <div class="w-full max-w-4xl px-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1403206316454!2d106.7904308!3d-6.245232199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f113962f18d3%3A0x5ca9b083e87d7616!2sPerpustakaan%20Umum%20Daerah%20Jakarta%20Selatan!5e0!3m2!1sid!2sid!4v1719042574049!5m2!1sid!2sid"
                        style="border: 2px solid #0f172a"
                        allowfullscreen=""
                        loading="lazy"
                        class="w-full h-64 rounded-lg border-Dark"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>
            </section>
            <section id="formContact" class="pb-32 flex justify-center">
                <div class="w-full max-w-4xl flex justify-between">
                    <div class="w-full px-4">
                        <div class="w-full max-w-full mb-8">
                            <h4
                                class="text-Dark font-semibold font-montserrat text-2xl mb-2 mt-10"
                            >
                                Hubungi Kami Untuk Info Lebih Lanjut!🖐
                            </h4>
                            <p class="text-Dark text-lg font-montserrat">
                                Jika Anda memiliki pertanyaan atau memerlukan
                                informasi lebih lanjut, jangan ragu untuk
                                menghubungi kami. Tim layanan pelanggan kami
                                siap membantu Anda. Hubungi kami melalui email,
                                atau form pada halaman ini.
                            </p>
                            <p class="text-Dark font-bold text-xl mt-5">
                                <a href="" class="hover:text-Hijau"
                                    >kpakselatan@gmail.com</a
                                >
                            </p>
                        </div>
                        <form @submit.prevent="submitForm">
                            <div class="mb-4">
                                <InputLabel
                                    for="name"
                                    value="Nama Lengkap"
                                    class="mb-2"
                                />
                                <TextInput
                                    v-model="form.name"
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    placeholder="Masukan Nama Lengkap"
                                    autocomplete="name"
                                />
                                <InputError
                                    :message="errors.name"
                                    class="mt-2"
                                />
                            </div>
                            <div class="mb-4">
                                <InputLabel
                                    for="email"
                                    value="Email"
                                    class="mb-2"
                                />
                                <TextInput
                                    v-model="form.email"
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    required
                                    placeholder="Masukan Email"
                                    autocomplete="email"
                                />
                                <InputError
                                    :message="errors.email"
                                    class="mt-2"
                                />
                            </div>
                            <div class="mb-4">
                                <InputLabel
                                    for="phone"
                                    value="No. Telepon"
                                    class="mb-2"
                                />
                                <TextInput
                                    v-model="form.phone"
                                    id="phone"
                                    type="number"
                                    class="mt-1 block w-full"
                                    required
                                    placeholder="Masukan No. Telepon"
                                    autocomplete="phone"
                                />
                                <InputError
                                    :message="errors.phone"
                                    class="mt-2"
                                />
                            </div>
                            <div class="mb-4">
                                <InputLabel
                                    for="institution"
                                    value="Institusi"
                                    class="mb-2"
                                />
                                <TextInput
                                    v-model="form.institution"
                                    id="institution"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    placeholder="Masukan Institusi"
                                    autocomplete="institution"
                                />
                                <InputError
                                    :message="errors.institution"
                                    class="mt-2"
                                />
                            </div>
                            <div class="mb-4">
                                <InputLabel
                                    for="message"
                                    value="Pesan"
                                    class="mb-2"
                                />
                                <textarea
                                    v-model="form.message"
                                    id="message"
                                    class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-Dark focus:border-Dark"
                                    required
                                    placeholder="Masukan Pesan"
                                    rows="4"
                                ></textarea>
                                <InputError
                                    :message="errors.message"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <button
                                    type="submit"
                                    class="px-4 py-2 w-full bg-Biru text-white rounded-lg hover:bg-Orange"
                                >
                                    Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </section>
        <!-- Modal for success message -->
        <div
            v-if="showModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm">
                <h2 class="text-2xl font-semibold mb-4">Pesan Terkirim!</h2>
                <p class="text-lg mb-4">Pesan Anda berhasil terkirim.</p>
                <button
                    @click="closeModal"
                    class="px-4 py-2 bg-Dark text-white rounded-lg"
                >
                    Tutup
                </button>
            </div>
        </div>
        <Footer />
    </section>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
    components: {
        Head,
        Navbar,
        Footer,
        InputError,
        InputLabel,
        TextInput,
    },
    props: {
        foto_tema: String,
        teks_tema: String,
    },
    data() {
        return {
            form: {
                name: "",
                email: "",
                phone: "",
                institution: "",
                message: "",
            },
            errors: {},
            showModal: false, // State untuk menampilkan modal
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await Inertia.post("/kontak", this.form);

                this.showModal = true;
                // Tampilkan modal jika pengiriman berhasil
                if (response.success) {
                    this.showModal = true;
                } else {
                    // Handle errors if necessary
                    this.errors = response.errors;
                }
            } catch (error) {
                console.error("Error submitting form:", error);
                // Handle other errors if necessary
            }
        },
        closeModal() {
            this.showModal = false;
        },
    },
};
</script>
