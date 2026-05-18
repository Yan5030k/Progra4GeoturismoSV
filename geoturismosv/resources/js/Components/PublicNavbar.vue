<script setup>
import { computed, ref, onMounted } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';

const page = usePage();

const isDark = ref(false);

onMounted(() => {
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        isDark.value = true;
        document.documentElement.classList.add('dark');
    } else {
        isDark.value = false;
        document.documentElement.classList.remove('dark');
    }
});

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

const toggleTheme = () => {
    isDark.value = !isDark.value;
    if (isDark.value) {
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
    }
};
</script>

<template>
    <header class="bg-white dark:bg-gray-900 shadow-sm transition-colors duration-300">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <Link href="/" class="flex items-center">
                <img
                    src="/img/logo-geoturismosv.png"
                    alt="Logo GeoTurismoSV"
                    class="h-16 w-auto transition-all duration-300 dark:bg-white/90 dark:px-3 dark:py-1 dark:rounded-xl"
                >
            </Link>

            <div class="flex items-center gap-3">
                <button
                    @click="toggleTheme"
                    class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition-colors"
                    title="Alternar tema"
                >
                    <svg v-if="!isDark" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <Link
                    href="/"
                    class="rounded-full border border-[#0b6fb3] bg-blue-50 dark:bg-blue-900/20 px-4 py-2 font-medium text-[#0b6fb3] dark:text-blue-400 transition hover:bg-[#0b6fb3] hover:text-white dark:hover:bg-[#0b6fb3] dark:hover:text-white"
                >
                    Inicio
                </Link>

                <Link
                    href="/destinos"
                    class="rounded-full border border-[#0b6fb3] bg-blue-50 dark:bg-blue-900/20 px-4 py-2 font-medium text-[#0b6fb3] dark:text-blue-400 transition hover:bg-[#0b6fb3] hover:text-white dark:hover:bg-[#0b6fb3] dark:hover:text-white"
                >
                    Destinos
                </Link>

                <Link
                    href="/categorias"
                    class="rounded-full border border-[#0b6fb3] bg-blue-50 dark:bg-blue-900/20 px-4 py-2 font-medium text-[#0b6fb3] dark:text-blue-400 transition hover:bg-[#0b6fb3] hover:text-white dark:hover:bg-[#0b6fb3] dark:hover:text-white"
                >
                    Categorías
                </Link>

                <Link
                    href="/sobre-nosotros"
                    class="rounded-full border border-[#0b6fb3] bg-blue-50 dark:bg-blue-900/20 px-4 py-2 font-medium text-[#0b6fb3] dark:text-blue-400 transition hover:bg-[#0b6fb3] hover:text-white dark:hover:bg-[#0b6fb3] dark:hover:text-white"
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