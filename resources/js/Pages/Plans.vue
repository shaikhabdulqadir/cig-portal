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
    <Head title="Plans" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <div class="w-full flex justify-center pb-16">
            <div class="w-full max-w-6xl mt-6">
                <div class="grid grid-cols-4 gap-4">
                    <div class="border-2 border-primary"></div>
                    <div class="border-2 border-[#666D80]"></div>
                    <div class="border-2 border-[#666D80]"></div>
                    <div class="border-2 border-[#666D80]"></div>
                </div>

                <h1 class="text-5xl font-bold text-center mt-4">
                    {{ __("Now select the program") }}
                </h1>
                <div class="text-center text-color1 text-lg mt-4">
                    {{ __("Which program is suitable for you?") }}
                </div>
                <div
                    class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6"
                >
                    <div
                        class="bg-white rounded-lg shadow-lg p-8 flex flex-col justify-between transform transition duration-300 hover:scale-105 hover:shadow-xl"
                    >
                        <div>
                            <div class="mb-4">
                                <h3
                                    class="text-2xl font-extrabold text-gray-900 text-center uppercase"
                                >
                                    BASIC + PLUS
                                </h3>
                            </div>
                            <p
                                class="text-2xl font-semibold text-gray-900 mb-4 pb-2 text-center planAmount"
                            >
                                {{ __("price_start") }}
                            </p>
                            <ul class="space-y-3 mb-6 text-gray-600">
                                <li class="flex items-center justify-center">
                                    <span>50GB Cloud Space</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Team Collaboration</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Project Management</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Instant Chat</span>
                                </li>
                            </ul>
                        </div>
                        <v-btn color="primary" variant="outlined">
                            {{ __("Choose Plan") }}
                        </v-btn>
                    </div>

                    <div
                        class="bg-white rounded-lg shadow-lg p-8 flex flex-col justify-between transform transition duration-300 hover:scale-105 hover:shadow-xl"
                    >
                        <div>
                            <div class="mb-4">
                                <h3
                                    class="text-2xl font-extrabold text-gray-900 text-center uppercase"
                                >
                                    {{ __("Start+ Plus") }}
                                </h3>
                            </div>
                            <p
                                class="text-2xl font-semibold text-gray-900 mb-4 pb-2 text-center planAmount"
                            >
                                {{ __("price_start_plus") }}
                            </p>
                            <ul class="space-y-3 mb-6 text-gray-600">
                                <li class="flex items-center justify-center">
                                    <span>100GB Cloud Space</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Team Collaboration</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Project Management</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Instant Chat</span>
                                </li>
                            </ul>
                        </div>
                        <v-btn color="primary" variant="outlined">
                            {{ __("Choose Plan") }}
                        </v-btn>
                    </div>

                    <div
                        class="bg-white rounded-lg shadow-lg p-8 flex flex-col justify-between transform transition duration-300 hover:scale-105 hover:shadow-xl relative z-10"
                    >
                        <div>
                            <div class="mb-4">
                                <h3
                                    class="text-2xl font-extrabold text-gray-900 text-center uppercase"
                                >
                                    {{ __("Business") }}
                                </h3>
                            </div>
                            <p
                                class="text-2xl font-semibold text-gray-900 mb-4 pb-2 text-center planAmount"
                            >
                                {{ __("price_business") }}
                            </p>
                            <ul class="space-y-3 mb-6 text-gray-600">
                                <li class="flex items-center justify-center">
                                    <span>200GB Cloud Space</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Team Collaboration</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Project Management</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Instant Chat</span>
                                </li>
                            </ul>
                        </div>
                        <button
                            class="w-full text-white bg-indigo-600 font-bold py-3 px-6 rounded-lg hover:bg-indigo-700 transition-colors duration-200"
                        >
                            Choose Plan
                        </button>
                    </div>

                    <div
                        class="bg-white rounded-lg shadow-lg p-8 flex flex-col justify-between transform transition duration-300 hover:scale-105 hover:shadow-xl"
                    >
                        <div>
                            <div class="mb-4">
                                <h3
                                    class="text-2xl font-extrabold text-gray-900 text-center uppercase"
                                >
                                    {{ __("Business +Plus") }}
                                </h3>
                            </div>
                            <p
                                class="text-2xl font-semibold text-gray-900 mb-4 pb-2 text-center planAmount"
                            >
                                {{ __("price_business_plus") }}
                            </p>
                            <ul class="space-y-3 mb-6 text-gray-600 list-none">
                                <li class="flex items-center justify-center">
                                    <span>500GB Cloud Space</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Team Collaboration</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Project Management</span>
                                </li>
                                <li class="flex items-center justify-center">
                                    <span>Instant Chat</span>
                                </li>
                            </ul>
                        </div>
                        <v-btn color="primary" variant="outlined">
                            {{ __("Choose Plan") }}
                        </v-btn>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticationCard>
</template>
<style scoped>
.planAmount {
    border-bottom: 1px solid #e1e9f0;
}
</style>
