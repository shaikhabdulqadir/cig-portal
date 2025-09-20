<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    addon: Object,
});

const isEdit = !!props.addon?.id;

const form = useForm({
    id: props.addon?.id ?? null,
    name: props.addon?.name ?? "",
    description: props.addon?.description ?? "",
    price: props.addon?.price ?? "",
    max_quantity: props.addon?.max_quantity ?? null,
    is_recurring: props.addon?.is_recurring ?? false,
});

const submit = () => {
    if (isEdit) {
        form.put(route("admin.addons.update", props.addon.id));
    } else {
        form.post(route("admin.addons.store"));
    }
};
</script>

<template>
    <AppLayout :title="isEdit ? 'Edit Addon' : 'Create Addon'">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{
                    isEdit
                        ? `Edit Addon: ${props.addon.name}`
                        : "Create New Addon"
                }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-bold text-gray-900">
                                {{ isEdit ? "Edit Addon" : "Create New Addon" }}
                            </h1>
                            <Link
                                :href="route('admin.addons.index')"
                                class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Back to Addons
                            </Link>
                        </div>

                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <v-text-field
                                    :label="__('Name')"
                                    v-model="form.name"
                                ></v-text-field>
                                <div
                                    v-if="form.errors.name"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <div>
                                <v-text-field
                                    :label="__('Description')"
                                    v-model="form.description"
                                ></v-text-field>
                                <div
                                    v-if="form.errors.description"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.description }}
                                </div>
                            </div>

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

                            <div>
                                <v-text-field
                                    :label="__('Max Quantity (optional)')"
                                    type="number"
                                    min="1"
                                    v-model="form.max_quantity"
                                ></v-text-field>
                                <div
                                    v-if="form.errors.max_quantity"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.max_quantity }}
                                </div>
                            </div>

                            <div>
                                <v-checkbox
                                    :label="__('Charge Monthly?')"
                                    v-model="form.is_recurring"
                                ></v-checkbox>

                                <div
                                    v-if="form.errors.is_recurring"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ form.errors.is_recurring }}
                                </div>
                            </div>

                            <div class="flex justify-end space-x-3">
                                <Link
                                    :href="route('admin.addons.index')"
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
                                            ? isEdit
                                                ? "Updating..."
                                                : "Creating..."
                                            : isEdit
                                            ? "Update Addon"
                                            : "Create Addon"
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
