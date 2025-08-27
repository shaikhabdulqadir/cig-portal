<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import { computed, ref } from "vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
    plan: Object,
    addons: Array,
});

const form = useForm({
    selectedAddons: [],
});

function addAddon(addon) {
    form.selectedAddons.push(addon);
}

function removeAddon(addon) {
    let index = form.selectedAddons.findIndex((x) => x.id == addon.id);
    form.selectedAddons.splice(index, 1);
}

const totalAmount = computed(() => {
    console.log("props", props.plan, form.selectedAddons);
    return (
        props.plan.price +
        form.selectedAddons
            .map((x) => Number(x.price))
            .reduce((acc, val) => acc + val, 0)
    );
});
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

                <div class="max-w-7xl mx-auto mt-6 p-6 sm:p-0">
                    <div
                        class="bg-white rounded-lg shadow-lg py-8 px-28 flex flex-col justify-between transform transition duration-300 hover:scale-105 hover:shadow-xl"
                    >
                        <h1 class="text-5xl font-bold text-center mt-4">
                            {{ __("Hey") }}, {{ $page.props.auth.user.name }}
                        </h1>
                        <div class="text-center text-color1 text-lg mt-4">
                            {{
                                __(
                                    "It looks like you've chosen a plan that's right for you."
                                )
                            }}
                        </div>
                        <div>
                            <div
                                class="mb-4 text-2xl font-bold text-gray-900 uppercase flex justify-between"
                            >
                                <div class="">
                                    {{ plan.name }}
                                </div>
                                <div>
                                    {{ plan.price }}
                                </div>
                            </div>
                            <ul class="space-y-3 mb-6 text-gray-600 list-none">
                                <li
                                    class="flex items-center"
                                    v-for="feature in plan.features"
                                >
                                    <span>
                                        {{ feature.feature_name }}
                                    </span>
                                </li>
                            </ul>

                            <div
                                class="border-t-2 border-b-2 py-8 border-gray-200"
                            >
                                <div
                                    class="text-2xl font-bold text-gray-900 mb-4"
                                >
                                    {{ __("Optional upgrades") }}
                                </div>
                                <div v-for="addon in addons">
                                    <div class="flex justify-between">
                                        <div>
                                            <div class="text-xl text-gray-900">
                                                {{ addon.name }}
                                            </div>
                                            <div class="flex items-center">
                                                <div class="text-gray-600">
                                                    {{ addon.description }}
                                                </div>
                                                <div class="ms-8">
                                                    <DangerButton
                                                        v-if="
                                                            form.selectedAddons.find(
                                                                (x) =>
                                                                    x.id ==
                                                                    addon.id
                                                            )
                                                        "
                                                        @click="
                                                            removeAddon(addon)
                                                        "
                                                    >
                                                        {{ __("Remove") }}
                                                    </DangerButton>
                                                    <v-btn
                                                        v-else
                                                        color="primary"
                                                        @click="addAddon(addon)"
                                                    >
                                                        {{ __("Add") }}
                                                    </v-btn>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-xl text-gray-900">
                                            <div>
                                                {{ addon.price }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="my-4 text-2xl font-bold text-gray-900 uppercase flex justify-between"
                            >
                                <div class="">
                                    {{ __("Total to pay") }}
                                </div>
                                <div>
                                    {{ totalAmount }}
                                </div>
                            </div>
                            <div class="flex justify-end mt-8">
                                <v-btn
                                    type="submit"
                                    variant="outlined"
                                    color="primary"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    append-icon="mdi-arrow-left"
                                >
                                    {{ __("Purchase") }}
                                </v-btn>
                            </div>
                        </div>
                        <!-- <v-btn color="primary" variant="outlined">
                            <Link :href="'/subscribe/' + plan.id">
                                {{ __("Choose Plan") }}
                            </Link>
                        </v-btn> -->
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
