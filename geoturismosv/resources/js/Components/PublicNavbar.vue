<script setup>
import { computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';

const page = usePage();

const usuario = computed(() => page.props.auth?.user ?? null);

const rutaPanel = computed(() => {
    if (!usuario.value) {
        return '/login';
    }

    return usuario.value.rol === 'admin'
        ? '/admin/dashboard'
        : '/usuario/panel';
});

const cerrarSesion = () => {
    router.post('/logout');
};
</script>

<template>
    <header class="bg-white shadow-sm">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <Link href="/" class="flex items-center">
                <img
                    src="/img/logo-geoturismosv.png"
                    alt="Logo GeoTurismoSV"
                    class="h-16 w-auto"
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
                    Destinos
                </Link>

                <Link
                    href="/categorias"
                    class="rounded-full border border-[#0b6fb3] bg-blue-50 px-4 py-2 font-medium text-[#0b6fb3] transition hover:bg-[#0b6fb3] hover:text-white"
                >
                    Categorías
                </Link>

                <Link
                    href="/sobre-nosotros"
                    class="rounded-full border border-[#0b6fb3] bg-blue-50 px-4 py-2 font-medium text-[#0b6fb3] transition hover:bg-[#0b6fb3] hover:text-white"
                >
                    Sobre nosotros
                </Link>

                <Link
                    v-if="!usuario"
                    href="/login"
                    class="rounded-full bg-[#f4a000] px-5 py-2 font-semibold text-white shadow transition hover:bg-orange-500"
                >
                    Iniciar sesión
                </Link>

                <template v-else>
                    <Link
                        :href="rutaPanel"
                        class="rounded-full bg-[#168a1a] px-5 py-2 font-semibold text-white shadow transition hover:bg-green-700"
                    >
                        Mi panel
                    </Link>

                    <Link
                        v-if="usuario.rol === 'usuario'"
                        href="/favoritos"
                        class="rounded-full bg-[#0b6fb3] px-5 py-2 font-semibold text-white shadow transition hover:bg-blue-700"
                    >
                        Mis favoritos
                    </Link>

                    <button
                        type="button"
                        @click="cerrarSesion"
                        class="rounded-full bg-red-600 px-5 py-2 font-semibold text-white shadow transition hover:bg-red-700"
                    >
                        Cerrar sesión
                    </button>
                </template>
            </div>
        </nav>

        <div class="h-1 w-full bg-gradient-to-r from-[#0b6fb3] via-[#1690c8] to-[#168a1a]"></div>
    </header>
</template>