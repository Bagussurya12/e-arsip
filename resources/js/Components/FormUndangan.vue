<template>
    <form @submit.prevent="submitForm">
        <div class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5">
            <div class="w-full md:w-1/2 flex flex-col space-y-2 mt-5">
                <InputLabel for="diposisi_acara" value="Disposisi Acara" />
                <TextInput
                    id="diposisi_acara"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.diposisi_acara"
                    autocomplete="on"
                    placeholder="Masukan Disposisi Acara"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.diposisi_acara"
                />
            </div>
            <div class="w-full md:w-1/2 flex flex-col space-y-2 mt-5">
                <InputLabel for="notulen" value="Notulen" />
                <TextInput
                    id="notulen"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.notulen"
                    autocomplete="on"
                    placeholder="Masukan Notulen"
                />
                <InputError class="mt-2" :message="form.errors.notulen" />
            </div>
        </div>

        <div class="mb-4 flex flex-wrap md:flex-nowrap md:space-x-6 mt-5">
            <div class="w-full md:w-1/2 flex flex-col space-y-2 mt-5">
                <InputLabel for="keterangan" value="Keterangan" />
                <TextInput
                    id="keterangan"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.keterangan"
                    autocomplete="on"
                    placeholder="Masukan Keterangan"
                />
                <InputError class="mt-2" :message="form.errors.keterangan" />
            </div>
            <div class="w-full md:w-1/2 flex flex-col space-y-2 mt-5">
                <InputLabel for="foto_kegiatan" value="Foto Kegiatan" />
                <input
                    id="foto_kegiatan"
                    type="file"
                    class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Biru file:text-white hover:file:bg-Orange"
                    @change="handleFileUpload"
                    placeholder="Masukan File Foto Kegiatan"
                    name="foto_kegiatan"
                />
                <InputError class="mt-2" :message="form.errors.foto_kegiatan" />
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    diposisi_acara: "",
    notulen: "",
    keterangan: "",
    foto_kegiatan: null,
});
</script>
