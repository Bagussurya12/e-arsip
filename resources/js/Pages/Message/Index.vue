<template>
    <Head title="Pesan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Pesan
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center">
                            <h5 class="text-gray-900">
                                Kelola Pengguna untuk menjaga keamanan Akun 🤞
                            </h5>
                            <input
                                type="text"
                                v-model="searchQuery"
                                @keyup.enter="handleSearchInput"
                                placeholder="Cari Pengirim Pesan Disini"
                                class="ml-4 p-2 border border-Dark rounded min-w-[200px] focus:ring-black"
                            />
                        </div>
                        <div
                            class="w-full border-t border-slate-700 mt-4"
                        ></div>
                        <div class="p-6 text-Dark">
                            <div
                                class="flex justify-between items-center mb-10"
                            >
                                <InputLabel class="mr-2">
                                    Total Data Pesan: {{ kontak.total }}
                                </InputLabel>
                            </div>
                            <div class="w-full">
                                <div
                                    class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3"
                                >
                                    <div
                                        v-for="(
                                            kontakItem, index
                                        ) in displayedKontak"
                                        :key="kontakItem.id"
                                        class="bg-gray-100 rounded-lg overflow-hidden shadow-lg transition-transform transform card-zoom"
                                    >
                                        <div class="p-6">
                                            <h3
                                                class="text-xl font-semibold text-Dark"
                                            >
                                                {{ kontakItem.name }}
                                            </h3>
                                            <p class="text-gray-600 mt-2">
                                                {{ kontakItem.email }}
                                            </p>
                                            <p class="text-gray-600 mt-2 mb-5">
                                                {{
                                                    truncateDescription(
                                                        kontakItem.message,
                                                        40
                                                    )
                                                }}
                                            </p>
                                            <p class="text-gray-600 mt-2 mb-5">
                                                {{ kontakItem.createdAt }}
                                            </p>
                                            <div class="justify-end text-end">
                                                <Link
                                                    :href="
                                                        route('detail.arsip', {
                                                            id: kontakItem.id,
                                                        })
                                                    "
                                                    class="bg-Dark hover:text-Hijau text-white font-base py-2 px-4 rounded"
                                                >
                                                    Detail
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between mt-4">
                                    <button
                                        @click="prevPage"
                                        :disabled="!kontak.prev_page_url"
                                        class="bg-gray-300 text-gray-700 py-2 px-4 rounded"
                                    >
                                        Previous
                                    </button>
                                    <button
                                        @click="nextPage"
                                        :disabled="!kontak.next_page_url"
                                        class="bg-gray-300 text-gray-700 py-2 px-4 rounded"
                                    >
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue"; // Pastikan path sudah benar

const props = defineProps({
    kontak: Object,
});
const searchQuery = ref("");

const prevPage = () => {
    if (props.kontak.prev_page_url) {
        Inertia.visit(props.kontak.prev_page_url);
    }
};

const nextPage = () => {
    if (props.kontak.next_page_url) {
        Inertia.visit(props.kontak.next_page_url);
    }
};

const displayedKontak = computed(() => {
    if (searchQuery.value.trim() === "") {
        return props.kontak.data;
    } else {
        return props.kontak.data.filter((kontak) =>
            kontak.name.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    }
});

const handleSearchInput = () => {
    if (searchQuery.value.trim() === "") {
        Inertia.visit(route("pesan"));
    } else {
        Inertia.get(
            route("pesan"),
            { search: searchQuery.value },
            {
                preserveState: true,
                replace: true,
            }
        );
    }
};

const truncateDescription = (text, length) => {
    if (text.length > length) {
        return text.substring(0, length) + "...";
    }
    return text;
};
</script>
