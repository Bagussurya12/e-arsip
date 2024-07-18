<template>
    <Head title="Edit Format Surat" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Edit Format Surat
            </h3>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="p-6 m-6 text-Dark bg-transparent rounded-xl mb-5">
                    <div class="justify-between items-center">
                        Edit Format Surat yang Telah Dipilih ✨
                    </div>
                </div>
                <!-- Garis horizontal di atas form -->
                <div class="w-full border-t border-slate-700"></div>
                <div class="p-6 text-Dark mt-5">
                    <form @submit.prevent="updateFormatSurat">
                        <div class="mb-4">
                            <InputLabel
                                class="block text-sm font-medium text-gray-700"
                                for="title"
                            >
                                Nama Format Surat
                            </InputLabel>
                            <TextInput
                                v-model="form.title"
                                type="text"
                                id="title"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="errors.title" />
                        </div>
                        <div class="mb-4 mt-4">
                            <InputLabel
                                class="block text-sm font-medium text-Dark mb-4"
                                for="file_surat"
                            >
                                File Surat (PDF, DOC, DOCX)
                            </InputLabel>
                            <input
                                ref="fileInput"
                                type="file"
                                id="file_surat"
                                class="block w-full text-lg text-Dark file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-Biru file:text-white hover:file:bg-Orange"
                                @change="handleFileChange"
                            />
                            <InputError
                                class="mt-2"
                                :message="errors.file_surat"
                            />
                        </div>
                        <!-- Tempat untuk pratinjau file -->
                        <div v-if="previewUrl" class="mt-4">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">
                                Pratinjau File
                            </h3>
                            <div v-if="isPdf">
                                <iframe
                                    :src="previewUrl"
                                    width="100%"
                                    height="600px"
                                ></iframe>
                            </div>
                            <div v-else>
                                <iframe
                                    :src="googleDocViewerUrl"
                                    width="100%"
                                    height="600px"
                                ></iframe>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-10">
                            <Link
                                :href="route('format.index')"
                                class="bg-Biru text-white font-bold py-2 px-4 rounded mr-4"
                            >
                                Batal
                            </Link>
                            <button
                                type="submit"
                                class="bg-Orange hover:bg-Orange-dark text-white font-bold py-2 px-4 rounded"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive, watch, computed } from "vue";
import { defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    format_surat: {
        type: Object,
        required: true,
    },
});

const form = reactive({
    title: props.format_surat.title,
    file_surat: null,
});

const fileInput = ref(null);
const errors = reactive({});
const previewUrl = ref(null);
const isPdf = ref(false);

const handleFileChange = () => {
    const file = fileInput.value.files[0];
    if (file) {
        const fileType = file.type;
        if (fileType === "application/pdf") {
            isPdf.value = true;
        } else {
            isPdf.value = false;
        }
        const reader = new FileReader();
        reader.onload = (e) => {
            previewUrl.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const googleDocViewerUrl = computed(() => {
    if (previewUrl.value && !isPdf.value) {
        return `https://docs.google.com/gview?url=${encodeURIComponent(
            previewUrl.value
        )}&embedded=true`;
    }
    return null;
});

const updateFormatSurat = () => {
    const formData = new FormData();
    formData.append("title", form.title);
    if (fileInput.value.files[0]) {
        formData.append("file_surat", fileInput.value.files[0]);
    }

    Inertia.post(
        route("format.update", { format: props.format_surat.id }),
        formData,
        {
            forceFormData: true,
            headers: {
                "X-HTTP-Method-Override": "PUT",
            },
            onSuccess: () => {
                Inertia.visit(route("format.index"));
            },
            onError: (formErrors) => {
                Object.keys(formErrors).forEach((key) => {
                    errors[key] = formErrors[key][0];
                });
            },
        }
    );
};
</script>
