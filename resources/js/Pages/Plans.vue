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
    plans: Array,
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
                <div class="grid grid-cols-4 gap-4 p-6 sm:p-0">
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
                    class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6 p-6 sm:p-0"
                >
                    <div
                        class="bg-white rounded-lg shadow-lg p-8 flex flex-col justify-between transform transition duration-300 hover:scale-105 hover:shadow-xl"
                        v-for="plan in plans"
                    >
                        <div>
                            <div class="mb-4">
                                <h3
                                    class="text-2xl font-extrabold text-gray-900 text-center uppercase"
                                >
                                    {{ plan.name }}
                                </h3>
                            </div>
                            <p
                                class="text-2xl font-semibold text-gray-900 mb-4 pb-2 text-center planAmount"
                            >
                                {{ plan.price }}
                            </p>
                            <ul class="space-y-3 mb-6 text-gray-600 list-none">
                                <li
                                    class="flex items-center justify-center"
                                    v-for="feature in plan.features"
                                >
                                    <span>
                                        {{ feature.feature_name }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <v-btn color="primary" variant="outlined">
                            <Link :href="'/select-plan/' + plan.id">
                                {{ __("Choose Plan") }}
                            </Link>
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
