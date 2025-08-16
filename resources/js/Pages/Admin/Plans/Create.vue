<script setup>
import { Head, useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    name: "",
    price: "",
    is_active: true,
    features: [{ feature_name: "", description: "" }],
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
                                <label
                                    for="name"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Plan Name
                                </label>
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    :class="{
                                        'border-red-500': form.errors.name,
                                    }"
                                />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    required
                                />
                                <div
                                    v-if="form.errors.name"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <!-- Price -->
                            <div>
                                <label
                                    for="price"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Price
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                    >
                                        <span class="text-gray-500 sm:text-sm"
                                            >$</span
                                        >
                                    </div>
                                    <input
                                        id="price"
                                        v-model="form.price"
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        required
                                        class="pl-7 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        :class="{
                                            'border-red-500': form.errors.price,
                                        }"
                                    />
                                </div>
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
                                        class="grid grid-cols-1 md:grid-cols-2 gap-4"
                                    >
                                        <div>
                                            <label
                                                :for="`feature_name_${index}`"
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                Feature Name
                                            </label>
                                            <input
                                                :id="`feature_name_${index}`"
                                                v-model="feature.feature_name"
                                                type="text"
                                                required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            />
                                        </div>
                                        <div>
                                            <label
                                                :for="`feature_description_${index}`"
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                Description
                                            </label>
                                            <input
                                                :id="`feature_description_${index}`"
                                                v-model="feature.description"
                                                type="text"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end space-x-3">
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
                                    {{
                                        form.processing
                                            ? "Creating..."
                                            : "Create Plan"
                                    }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
