<template>
    <Head title="Tema" />
    <AuthenticatedLayout class="w-full">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-Dark leading-tight">
                Pengaturan Tema
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <section>
                    <header class="m-6 space-y-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Atur Tema Sesuai Dengan Event Yang Berjalan ✨
                        </h2>
                        <div
                            class="w-full border-t border-slate-700 my-10"
                        ></div>
                    </header>

                    <div class="p-6 text-Dark overflow-auto">
                        <div class="flex justify-between items-center mb-10">
                            <Link
                                :href="route('tema.create')"
                                class="bg-Orange hover:text-white text-white font-bold py-2 px-4 rounded"
                            >
                                Tema
                            </Link>
                        </div>

                        <div class="flex justify-center max-w-ful">
                            <div
                                class="flex flex-wrap md:flex-nowrap md:space-x-4"
                            >
                                <div
                                    v-for="temaItem in tema"
                                    :key="temaItem.id"
                                    class="flex flex-col items-center justify-center p-4"
                                >
                                    <img
                                        :src="`/storage/${temaItem.foto_tema}`"
                                        alt="Theme Photo"
                                        class="rounded-lg h-64 w-64 object-cover mx-auto border-4 border-Dark"
                                    />
                                    <h3
                                        class="mt-2 text-lg font-medium text-gray-900"
                                    >
                                        {{ temaItem.teks_tema }}
                                    </h3>
                                    <Link
                                        :href="route('tema.edit', temaItem.id)"
                                        class="bg-Biru mt-10 hover:bg-dark-blue text-white font-bold py-2 px-4 rounded"
                                    >
                                        Update Tema
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { defineProps } from "vue";

const props = defineProps({
    tema: Array, // Pastikan tema adalah array
});
</script>
