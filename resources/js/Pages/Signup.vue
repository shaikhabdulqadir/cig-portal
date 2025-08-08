<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <div class="w-full flex justify-center">
            <div class="w-full max-w-6xl mt-6">
                <div class="grid grid-cols-4 gap-4">
                    <div class="border-2 border-primary"></div>
                    <div class="border-2 border-[#666D80]"></div>
                    <div class="border-2 border-[#666D80]"></div>
                    <div class="border-2 border-[#666D80]"></div>
                </div>
                <div
                    class="bg-white shadow-lg overflow-hidden m-auto rounded-lg mt-8 p-16"
                >
                    <div>
                        <h1 class="text-5xl font-bold text-center">
                            {{ __("Create an account") }}
                        </h1>
                    </div>
                    <div class="m-8">
                        <div
                            v-if="status"
                            class="mb-4 font-medium text-sm text-green-600"
                        >
                            {{ status }}
                        </div>

                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-2">
                                <div class="px-4">
                                    <div>
                                        <v-text-field
                                            v-model="form.name"
                                            :label="__('Full Name')"
                                        ></v-text-field>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.name"
                                        />
                                    </div>
                                    <div>
                                        <v-text-field
                                            v-model="form.phone"
                                            :label="__('Phone')"
                                        ></v-text-field>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.phone"
                                        />
                                    </div>
                                </div>
                                <div class="px-4">
                                    <div>
                                        <v-text-field
                                            v-model="form.company_name"
                                            :label="__('Company Name')"
                                        ></v-text-field>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.name"
                                        />
                                    </div>
                                    <div>
                                        <v-text-field
                                            v-model="form.license"
                                            :label="
                                                __('H.P. / Licensed Dealer')
                                            "
                                        ></v-text-field>
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.phone"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="px-4">
                                <v-text-field
                                    v-model="form.email"
                                    :label="__('Email')"
                                ></v-text-field>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <!-- <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Forgot your password?
                </Link> -->

                                <v-btn
                                    variant="outlined"
                                    color="primary"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    append-icon="mdi-arrow-left"
                                >
                                    {{ __("To select program") }}
                                </v-btn>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticationCard>
</template>
