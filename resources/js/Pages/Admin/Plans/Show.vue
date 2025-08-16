<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    plan: Object,
});
</script>

<template>
    <AppLayout :title="`Plan: ${plan.name}`">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Plan Details: {{ plan.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-3xl font-bold text-gray-900">Plan Details</h1>
                            <div class="flex space-x-2">
                                <Link
                                    :href="route('admin.plans.edit', plan.id)"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded"
                                >
                                    Edit Plan
                                </Link>
                                <Link
                                    :href="route('admin.plans.index')"
                                    class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                >
                                    Back to Plans
                                </Link>
                            </div>
                        </div>

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ plan.name }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Plan information and features
                                </p>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Plan Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ plan.name }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Price
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            ${{ plan.price }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Status
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <span
                                                :class="[
                                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                                    plan.is_active
                                                        ? 'bg-green-100 text-green-800'
                                                        : 'bg-red-100 text-red-800'
                                                ]"
                                            >
                                                {{ plan.is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Created At
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ new Date(plan.created_at).toLocaleDateString() }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Last Updated
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ new Date(plan.updated_at).toLocaleDateString() }}
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Features
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <div v-if="plan.features && plan.features.length > 0">
                                                <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                                    <li v-for="feature in plan.features" :key="feature.id" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                        <div class="w-0 flex-1 flex items-center">
                                                            <span class="ml-2 flex-1 w-0 truncate">
                                                                {{ feature.feature_name }}
                                                            </span>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div v-if="plan.features.some(f => f.description)" class="mt-4">
                                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Feature Details:</h4>
                                                    <div v-for="feature in plan.features" :key="feature.id" v-if="feature.description" class="mb-2">
                                                        <span class="font-medium text-sm">{{ feature.feature_name }}:</span>
                                                        <span class="text-sm text-gray-600 ml-2">{{ feature.description }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-else class="text-gray-500">
                                                No features added to this plan.
                                            </div>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template> 