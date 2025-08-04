<template>
    <div
        class="min-h-screen pt-6 sm:pt-0 bg-gradient-to-t from-cyan-300 to-slate-100"
    >
        <div class="p-10">
            <slot name="logo" />
        </div>

        <div
            class="w-full max-w-4xl mt-6 p-16 bg-white shadow-lg overflow-hidden m-auto rounded-lg"
        >
            <slot />
        </div>

        <div class="w-full bg-white fixed bottom-0 text-center p-2 text-sm">
            © כל הזכויות שמורות שיג ושיח | תקנון | הצהרת נגישות
        </div>
    </div>
</template>
