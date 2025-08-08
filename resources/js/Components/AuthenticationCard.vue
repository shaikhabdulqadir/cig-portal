<template>
    <div
        class="min-h-screen overflow-y-scroll1 pt-6 sm:pt-0 bg-gradient-to-t from-cyan-300 to-slate-100"
    >
        <div class="p-10">
            <slot name="logo" />
        </div>

        <div>
            <slot />
        </div>

        <div class="w-full bg-white fixed bottom-0 text-center p-2 text-sm z-1">
            © כל הזכויות שמורות שיג ושיח | תקנון | הצהרת נגישות
        </div>
    </div>
</template>
