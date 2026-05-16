<script setup>
import { Link, router } from '@inertiajs/vue3';

const cerrarSesion = () => {
    router.post('/logout');
};
</script>

<template>
    <header class="bg-white shadow-sm">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <Link href="/usuario/panel" class="flex items-center">
                <img
                    src="/img/logo-geoturismosv.png"
                    alt="Logo GeoTurismoSV"
                    class="h-14 w-auto"
                >
            </Link>

            <div class="flex items-center gap-3">
                <Link
                    href="/"
                    class="rounded-full border border-[#0b6fb3] bg-blue-50 px-4 py-2 font-medium text-[#0b6fb3] transition hover:bg-[#0b6fb3] hover:text-white"
                >
                    Inicio
                </Link>

                <Link
                    href="/destinos"
                    class="rounded-full border border-[#0b6fb3] bg-blue-50 px-4 py-2 font-medium text-[#0b6fb3] transition hover:bg-[#0b6fb3] hover:text-white"
                >
                    Explorar destinos
                </Link>

                <Link
                    href="/usuario/panel"
                    class="rounded-full border border-[#0b6fb3] bg-blue-50 px-4 py-2 font-medium text-[#0b6fb3] transition hover:bg-[#0b6fb3] hover:text-white"
                >
                    Mi panel
                </Link>

                <Link
                    href="/favoritos"
                    class="rounded-full border border-[#168a1a] bg-green-50 px-4 py-2 font-medium text-[#168a1a] transition hover:bg-[#168a1a] hover:text-white"
                >
                    Mis favoritos
                </Link>

                <button
                    @click="cerrarSesion"
                    class="rounded-full bg-red-600 px-5 py-2 font-semibold text-white shadow transition hover:bg-red-700"
                >
                    Cerrar sesión
                </button>
            </div>
        </nav>

        <div class="h-1 w-full bg-gradient-to-r from-[#0b6fb3] via-[#1690c8] to-[#168a1a]"></div>
    </header>
</template>
