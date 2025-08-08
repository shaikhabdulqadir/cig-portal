<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="btn-primary inline-flex items-center px-4 py-2 border-primary border-transparent rounded-md font-semibold text-xs text-primary uppercase tracking-widest hover:bg-primary active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
