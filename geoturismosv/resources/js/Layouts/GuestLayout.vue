<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="relative flex min-h-screen flex-col items-center justify-center py-12 sm:px-6 lg:px-8 bg-cover bg-center bg-no-repeat"
        style="background-image: url('/images/login_bg.png');"
    >
        <!-- Oscurecer el fondo para que el texto y la tarjeta resalten -->
        <div class="absolute inset-0 bg-black/40 z-0"></div>

        <div class="relative z-10 w-full sm:max-w-md flex flex-col items-center">
            <Link href="/">
                <!-- Reemplazado por el logo oficial (se redujo de h-24 a h-16 para mayor nitidez) -->
                <img src="/img/logo-geoturismosv.png" alt="Logo GeoturismoSV" class="h-16 w-auto drop-shadow-[0_5px_10px_rgba(0,0,0,0.5)] transition-transform duration-300 hover:scale-105" />
            </Link>
            
            <p class="mt-4 text-center text-sm text-gray-200 drop-shadow font-medium">
                Donde cada lugar cuenta una historia
            </p>
        </div>

        <div
            class="relative z-10 mt-8 w-full sm:max-w-md overflow-hidden bg-white/90 backdrop-blur-xl px-8 py-10 shadow-[0_8px_30px_rgb(0,0,0,0.2)] sm:rounded-3xl border border-white/50"
        >
            <slot />
        </div>
    </div>
</template>
