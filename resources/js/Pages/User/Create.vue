<template>
    <Head title="Tambah Pengguna" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Tambah Pengguna
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-black">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    Tambah Pengguna
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    Tambah Pengguna Untuk Dapat Mengakses Sistem
                                    🤞
                                </p>
                                <div
                                    class="w-full border-t border-slate-700 my-10"
                                ></div>
                            </header>

                            <form
                                @submit.prevent="
                                    form.patch(route('profile.update'))
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

                                <div
                                    v-if="
                                        props.mustVerifyEmail &&
                                        user.email_verified_at === null
                                    "
                                >
                                    <p class="text-sm mt-2 text-gray-800">
                                        Your email address is unverified.
                                        <Link
                                            :href="route('verification.send')"
                                            method="post"
                                            as="button"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            Click here to re-send the
                                            verification email.
                                        </Link>
                                    </p>

                                    <div
                                        v-show="
                                            props.status ===
                                            'verification-link-sent'
                                        "
                                        class="mt-2 font-medium text-sm text-green-600"
                                    >
                                        A new verification link has been sent to
                                        your email address.
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton :disabled="form.processing"
                                        >Save</PrimaryButton
                                    >

                                    <Transition
                                        enter-from-class="opacity-0"
                                        leave-to-class="opacity-0"
                                        class="transition ease-in-out"
                                    >
                                        <p
                                            v-if="form.recentlySuccessful"
                                            class="text-sm text-gray-600"
                                        >
                                            Saved.
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
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: "",
    email: "",
});
</script>
