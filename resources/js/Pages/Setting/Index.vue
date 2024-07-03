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
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
</script>
