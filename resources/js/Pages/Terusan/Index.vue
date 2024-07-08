<template>
    <Head title="Data Terusan" />

    <AuthenticatedLayout>
        <template #header>
            <h3 class="font-semibold text-lg text-Dark leading-tight">
                Daftar Data Terusan
            </h3>
        </template>
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-Dark overflow-auto">
                    <div class="flex justify-between items-center mb-10">
                        <div class="flex items-center">
                            <label class="mr-2">
                                Total Data Terusan: {{ terusans.length }}
                            </label>
                        </div>
                        <Link
                            :href="route('terusan.create')"
                            class="bg-Orange hover:text-white text-white font-bold py-2 px-4 rounded"
                        >
                            Tambah Data Terusan
                        </Link>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="mb-5">
                                <tr class="border-b-2">
                                    <th
                                        class="px-2 py-3 text-center text-lg font-medium text-Dark"
                                    >
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                    >
                                        Nama Data
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-lg font-medium text-Dark"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="(terusan, index) in terusans"
                                    :key="terusan.id"
                                >
                                    <td class="px-2 py-4 text-center">
                                        {{ index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ terusan.value }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div
                                            class="flex justify-center space-x-2"
                                        >
                                            <Link
                                                :href="
                                                    route('terusan.edit', {
                                                        terusan: terusan.id,
                                                    })
                                                "
                                                class="text-Orange hover:text-Orange font-medium"
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                @click="
                                                    confirmDelete(terusan.id)
                                                "
                                                class="text-Red hover:text-Red font-medium"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const { terusans } = usePage().props;

function confirmDelete(terusanId) {
    if (confirm("Are you sure you want to delete this item?")) {
        // Implement delete logic here
        // Example: Use Inertia to delete item
        // Example: You may need to import `inertia` to use it here
        // inertia.delete(route('terusan.destroy', { terusan: terusanId }));
    }
}
</script>
