<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import { computed, ref } from "vue";
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
    plan: Object,
    addons: Array,
    totalAmount: Number,
});

const form = useForm({
    cardholder_name: "",
    card_number: "",
    exp: "",
    cvc: "",
});

function addAddon(addon) {
    form.selectedAddons.push(addon);
}

function removeAddon(addon) {
    let index = form.selectedAddons.findIndex((x) => x.id == addon.id);
    form.selectedAddons.splice(index, 1);
}

function submit() {
    form.post(route("subscribe"));
}
</script>

<template>
    <Head title="Addons" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <div class="w-full flex justify-center pb-16">
            <div class="w-full max-w-6xl mt-6">
                <div class="grid grid-cols-4 gap-4 p-6 sm:p-0">
                    <div class="border-2 border-primary"></div>
                    <div class="border-2 border-primary"></div>
                    <div class="border-2 border-primary"></div>
                    <div class="border-2 border-[#666D80]"></div>
                </div>

                <div class="max-w-7xl mx-auto p-6 sm:p-0">
                    <div class="flex justify-center mt-16">
                        <div
                            class="w-full max-w-md bg-white rounded-xl shadow-2xl py-6 md:p-8"
                        >
                            <div class="text-center">
                                <h1 class="text-4xl font-bold text-center mt-4">
                                    {{ __("Payment") }}
                                </h1>
                            </div>

                            <div
                                class="my-4 rounded p-4 text-sm text-red-800 bg-red-200 dark:bg-gray-800 dark:text-red-400"
                                role="alert"
                                v-if="$page.props.error"
                            >
                                <span class="font-medium"
                                    >{{ __("Error") }}!</span
                                >
                                {{ $page.props.error }}
                            </div>
                            <div
                                class="p-4 mb-4 text-sm text-green-800 bg-green-200 dark:bg-gray-800 dark:text-green-400"
                                role="alert"
                                v-if="$page.props?.success"
                            >
                                <span class="font-medium"
                                    >{{ __("Success") }}!</span
                                >
                                {{ $page.props?.success }}
                            </div>

                            <!-- <div class="space-y-3 mb-6">
                                <button
                                    class="w-full flex items-center justify-center h-12 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition duration-300"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 mr-2"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M12 1.95c.57.06 1.05.54 1.11 1.11v18c-.06.57-.54 1.05-1.11 1.11H4.95c-.57-.06-1.05-.54-1.11-1.11V3.06c.06-.57.54-1.05 1.11-1.11h7.05M12 21.05v-18H4.95v18H12m0-18c.57.06 1.05.54 1.11 1.11v18c-.06.57-.54 1.05-1.11 1.11h7.05c.57-.06 1.05-.54 1.11-1.11V3.06c-.06-.57-.54-1.05-1.11-1.11H12"
                                        />
                                    </svg>
                                    <span>Apple Pay</span>
                                </button>
                                <button
                                    class="w-full flex items-center justify-center h-12 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition duration-300"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 mr-2"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M12 2.25C6.07 2.25 1.25 7.07 1.25 13c0 4.14 2.37 7.74 5.86 9.32a.75.75 0 0 0 .89-.83c-.1-.5-.14-1.1-.14-1.64 0-1.84.97-2.92 2.3-3.66 1.25-.72 2.87-1.16 4.35-.9.46.08.9.18 1.34.28 1.4.34 2.85.8 4.04 1.48 1.45.83 2.58 2.05 3.32 3.52.88 1.76 1.28 3.5 1.28 5.25a.75.75 0 0 0 .75.75c.1 0 .2-.01.29-.03 5.42-1.3 9.46-6.1 9.46-11.83C22.75 7.07 17.93 2.25 12 2.25zM12 21.75c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"
                                        />
                                    </svg>
                                    <span>G Pay</span>
                                </button>
                            </div> -->

                            <!-- <div class="relative flex items-center py-5">
                                <div
                                    class="flex-grow border-t border-gray-300"
                                ></div>
                                <span
                                    class="flex-shrink mx-4 text-sm text-gray-500"
                                    >או לשלם בדרך אחרת</span
                                >
                                <div
                                    class="flex-grow border-t border-gray-300"
                                ></div>
                            </div> -->

                            <!-- <div
                                class="grid grid-cols-4 gap-2 mb-6 text-center"
                            >
                                <div
                                    class="p-2 border border-gray-300 rounded-lg text-gray-700 text-sm"
                                >
                                    קומאשראי
                                </div>
                                <div
                                    class="p-2 border border-gray-300 rounded-lg text-gray-700 text-sm"
                                >
                                    ביט
                                </div>
                                <div
                                    class="p-2 border border-gray-300 rounded-lg text-gray-700 text-sm"
                                >
                                    מולטיפאס
                                </div>
                                <div
                                    class="p-2 border border-gray-300 rounded-lg text-gray-700 text-sm"
                                >
                                    Buy Me
                                </div>
                            </div> -->
                            <form @submit.prevent="submit">
                                <div class="my-4">
                                    <label
                                        for="cardholder-name"
                                        class="block text-right text-gray-700 text-sm mb-1"
                                    >
                                        {{ __("Cardholder name") }}
                                    </label>
                                    <input
                                        type="text"
                                        id="cardholder-name"
                                        :placeholder="__('Cardholder name')"
                                        v-model="form.cardholder_name"
                                        class="w-full px-4 py-2 bg-gray-100 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition duration-200 text-right"
                                    />
                                    <InputError
                                        :message="form.errors.cardholder_name"
                                    />
                                </div>

                                <div class="mb-6">
                                    <label
                                        for="card-number"
                                        class="block text-right text-gray-700 text-sm mb-1"
                                    >
                                        {{ __("Card number") }}
                                    </label>
                                    <div
                                        class="flex items-center space-x-2 rtl:space-x-reverse mb-2"
                                    >
                                        <!-- <div class="flex-shrink-0">
                                        <img
                                            src="https://via.placeholder.com/40x25.png?text=AMEX"
                                            alt="Amex"
                                            class="h-6"
                                        />
                                    </div>
                                    <div class="flex-shrink-0">
                                        <img
                                            src="https://via.placeholder.com/40x25.png?text=VISA"
                                            alt="Visa"
                                            class="h-6"
                                        />
                                    </div> -->
                                        <input
                                            type="number"
                                            v-model="form.card_number"
                                            id="card-number"
                                            placeholder="1234 1234 1234 1234"
                                            class="w-full px-4 py-2 bg-gray-100 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition duration-200 text-right"
                                        />
                                    </div>
                                    <InputError
                                        :message="form.errors.card_number"
                                    />

                                    <div
                                        class="flex space-x-2 rtl:space-x-reverse"
                                    >
                                        <div class="w-1/2">
                                            <label
                                                for="cardholder-name"
                                                class="block text-right text-gray-700 text-sm mb-1"
                                            >
                                                {{ __("Exp (Month/Year)") }}
                                            </label>
                                            <input
                                                type="text"
                                                v-model="form.exp"
                                                :placeholder="__('month/year')"
                                                class="w-full px-4 py-2 bg-gray-100 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition duration-200 text-right"
                                            />
                                            <InputError
                                                :message="form.errors.exp"
                                            />
                                        </div>
                                        <div class="w-1/2">
                                            <label
                                                for="cardholder-name"
                                                class="block text-right text-gray-700 text-sm mb-1"
                                            >
                                                {{ __("CVV") }}
                                            </label>
                                            <input
                                                type="text"
                                                v-model="form.cvc"
                                                placeholder="CVC"
                                                class="w-full px-4 py-2 bg-gray-100 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition duration-200 text-right"
                                            />
                                            <InputError
                                                :message="form.errors.cvc"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mb-6">
                                    <p class="text-xl font-bold text-gray-800">
                                        {{ __("Total:") }}
                                        {{ totalAmount }}
                                    </p>
                                </div>

                                <v-btn
                                    color="primary"
                                    class="w-full"
                                    type="submit"
                                >
                                    {{ __("Pay Now") }}
                                </v-btn>
                            </form>
                        </div>
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
