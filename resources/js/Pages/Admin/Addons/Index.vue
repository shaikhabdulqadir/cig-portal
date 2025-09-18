<script setup>
import { Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
    addons: Array,
})

const destroy = (id) => {
    if (confirm('Are you sure you want to delete this addon?')) {
        router.delete(route('admin.addons.destroy', id))
    }
}
</script>

<template>
    <AppLayout title="Addons">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Addons</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-bold text-gray-900">Addons</h1>
                            <Link :href="route('admin.addons.create')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Addon</Link>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 ltr:text-left rtl:text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 ltr:text-left rtl:text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                        <th class="px-6 py-3 ltr:text-left rtl:text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                        <th class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="addon in addons" :key="addon.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ addon.name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ addon.description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ addon.price }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2
                                             rtl:space-x-reverse
                                        ">
                                            <Link :href="route('admin.addons.edit', addon.id)" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
                                            <button @click="destroy(addon.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


