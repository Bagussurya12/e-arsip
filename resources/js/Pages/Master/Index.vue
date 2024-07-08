<template>
    <Head title="Master" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-lg text-gray-Dark leading-tight">
                Master
            </h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <section>
                    <div class="p-6 text-Dark overflow-auto">
                        <div>
                            <h1>Halaman Master</h1>
                            <div class="flex flex-col space-y-4 mt-4">
                                <button
                                    @click="navigateTo('terusan')"
                                    class="bg-orange-500 text-white py-2 px-4 rounded"
                                >
                                    Mengatur Data Terusan
                                </button>
                                <button
                                    @click="navigateTo('naskah-dinas')"
                                    class="bg-orange-500 text-white py-2 px-4 rounded"
                                >
                                    Mengatur Naskah Dinas
                                </button>
                                <button
                                    @click="navigateTo('tema')"
                                    class="bg-orange-500 text-white py-2 px-4 rounded"
                                >
                                    Mengatur Tema
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

function navigateTo(route) {
    this.$inertia.visit(`/${route}`);
}
</script>
