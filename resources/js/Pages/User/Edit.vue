<template>
    <Head title="Edit Pengguna" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Edit Pengguna
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-black">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    Edit Pengguna
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    Edit Pengguna Untuk Dapat Mengakses Sistem
                                    dan Menambahkan Keamanan Akun 🤞
                                </p>
                                <div
                                    class="w-full border-t border-slate-700 my-10"
                                ></div>
                            </header>

                            <form
                                @submit.prevent="
                                    form.put(route('users.update', user.id))
                                "
                                class="mt-6 space-y-6"
                            >
                                <div>
                                    <InputLabel
                                        for="name"
                                        value="Nama Lengkap"
                                        class="mb-2"
                                    />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        placeholder="Masukan Nama Lengkap"
                                        autocomplete="name"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.name"
                                    />
                                </div>

                                <div>
                                    <InputLabel for="email" value="Email" />
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        required
                                        autocomplete="username"
                                        placeholder="Masukan Email"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.email"
                                    />
                                </div>

                                <div>
                                    <InputLabel for="role" value="Role" />
                                    <SelectBox
                                        v-model="form.role"
                                        :options="dropdownOptions"
                                        label="Pilih Role"
                                        id="select-box"
                                        name="selectBox"
                                        placeholder="Pilih Role"
                                        required
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.role"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="password"
                                        value="Kata Sandi"
                                    />
                                    <TextInput
                                        id="password"
                                        ref="passwordInput"
                                        v-model="form.password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        autocomplete="new-password"
                                        placeholder="Masukan Kata Sandi"
                                    />
                                    <InputError
                                        :message="form.errors.password"
                                        class="mt-2"
                                    />
                                </div>

                                <div>
                                    <InputLabel
                                        for="password_confirmation"
                                        value="Konfirmasi Kata Sandi"
                                    />
                                    <TextInput
                                        id="password_confirmation"
                                        v-model="form.password_confirmation"
                                        type="password"
                                        class="mt-1 block w-full"
                                        autocomplete="new-password"
                                        placeholder="Masukan Konfirmasi Kata Sandi"
                                    />
                                    <InputError
                                        :message="
                                            form.errors.password_confirmation
                                        "
                                        class="mt-2"
                                    />
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton :disabled="form.processing">
                                        Simpan
                                    </PrimaryButton>
                                    <Transition
                                        enter-from-class="opacity-0"
                                        leave-to-class="opacity-0"
                                        class="transition ease-in-out"
                                    >
                                        <p
                                            v-if="form.recentlySuccessful"
                                            class="text-sm text-gray-600"
                                        >
                                            Data Berhasil Disimpan!
                                        </p>
                                    </Transition>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectBox from "@/Components/SelectBox.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: "",
    password_confirmation: "",
    role: props.user.role,
});

const dropdownOptions = [
    { value: "admin", label: "Admin" },
    { value: "user", label: "User" },
];
</script>
