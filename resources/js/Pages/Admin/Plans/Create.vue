<script setup>
import { Head, useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    plan: Object,
});

const form = useForm({
    id: props.plan?.id ?? null,
    name: props.plan?.name ?? "",
    api_name: props.plan?.api_name ?? "",
    price: props.plan?.price ?? "",
    is_active: props.plan?.is_active ?? false,
    features:
        props.plan?.features.length > 0
            ? props.plan.features.map((f) => ({
                  feature_name: f.feature_name,
                  description: f.description || "",
                  id: f.id,
              }))
            : [{ feature_name: "", description: "" }],
});

const addFeature = () => {
    form.features.push({ feature_name: "", description: "" });
};

const removeFeature = (index) => {
    if (form.features.length > 1) {
        form.features.splice(index, 1);
    }
};

const submit = () => {
    // Filter out empty features
    form.features = form.features.filter(
        (feature) => feature.feature_name.trim() !== ""
    );

    form.post(route("admin.plans.store"));
};
</script>

<template>
    <AppLayout title="Create Plan">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Plan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-3xl font-bold text-gray-900">
                                Create New Plan
                            </h1>
                            <Link
                                :href="route('admin.plans.index')"
                                class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Back to Plans
                            </Link>
                        </div>

                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Plan Name -->
                            <div>
                                <v-text-field
                                    :label="__('Plan Name')"
                                    v-model="form.name"
                                ></v-text-field>
                                <div
                                    v-if="form.errors.name"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <!-- Price -->
                            <div>
                                <v-text-field
                                    :label="__('API Name')"
                                    v-model="form.api_name"
                                ></v-text-field>
                            </div>

                            <!-- Price -->
                            <div>
                                <v-text-field
                                    v-model="form.price"
                                    :label="__('Price')"
                                    prefix="₪"
                                    type="number"
                                    step="0.01"
                                    outlined
                                    dense
                                />

                                <div
                                    v-if="form.errors.price"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.price }}
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div>
                                <label class="flex items-center">
                                    <input
                                        v-model="form.is_active"
                                        type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    />
                                    <span class="ml-2 text-sm text-gray-700"
                                        >Active Plan</span
                                    >
                                </label>
                            </div>

                            <!-- Features -->
                            <div>
                                <div
                                    class="flex justify-between items-center mb-4"
                                >
                                    <label
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Features
                                    </label>
                                    <button
                                        type="button"
                                        @click="addFeature"
                                        class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold py-1 px-3 rounded"
                                    >
                                        Add Feature
                                    </button>
                                </div>

                                <div
                                    v-for="(feature, index) in form.features"
                                    :key="index"
                                    class="border border-gray-200 rounded-lg p-4 mb-4"
                                >
                                    <div
                                        class="flex justify-between items-start mb-3"
                                    >
                                        <h4
                                            class="text-sm font-medium text-gray-700"
                                        >
                                            Feature {{ index + 1 }}
                                        </h4>
                                        <button
                                            v-if="form.features.length > 1"
                                            type="button"
                                            @click="removeFeature(index)"
                                            class="text-red-600 hover:text-red-800 text-sm"
                                        >
                                            Remove
                                        </button>
                                    </div>

                                    <div
                                        class="grid grid-cols-1 md:grid-cols-1 gap-4"
                                    >
                                        <div>
                                            <v-text-field
                                                :label="__('Feature Name')"
                                                v-model="feature.feature_name"
                                            ></v-text-field>
                                        </div>
                                        <!-- <div>
                                            <v-textarea
                                                label="Description"
                                                v-model="feature.description"
                                            ></v-textarea>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div
                                class="flex justify-end space-x-3 rtl:space-x-reverse"
                            >
                                <Link
                                    :href="route('admin.plans.index')"
                                    class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                >
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white font-bold py-2 px-4 rounded"
                                >
                                    <span v-if="form.id">
                                        {{
                                            form.processing
                                                ? "Updating..."
                                                : "Update Plan"
                                        }}
                                    </span>
                                    <span v-else>
                                        {{
                                            form.processing
                                                ? "Creating..."
                                                : "Create Plan"
                                        }}
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
