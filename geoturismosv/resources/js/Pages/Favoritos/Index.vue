<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import UserNavbar from '@/Components/UserNavbar.vue';

defineProps({
    favoritos: Array,
});

const obtenerImagenDestino = (destino) => {
    if (!destino?.imagen) {
        return '/img/logo-geoturismosv.png';
    }

    if (destino.imagen.startsWith('http')) {
        return destino.imagen;
    }

    if (destino.imagen.startsWith('/')) {
        return destino.imagen;
    }

    if (destino.imagen.startsWith('img/')) {
        return `/${destino.imagen}`;
    }

    return `/storage/${destino.imagen}`;
};

const eliminarFavorito = (destinoId) => {
    router.delete(`/favoritos/${destinoId}`, {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Mis favoritos" />

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50">
        <UserNavbar />

        <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <section class="rounded-3xl bg-white p-8 shadow-xl ring-1 ring-slate-100">
                <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wide text-[#168a1a]">
                            Usuario
                        </p>

                        <h1 class="mt-3 text-4xl font-black tracking-tight text-gray-900 sm:text-5xl">
                            Mis destinos favoritos
                        </h1>

                        <p class="mt-4 max-w-3xl text-lg leading-8 text-gray-600">
                            Aquí puedes revisar los destinos turísticos que guardaste para visitarlos,
                            compararlos o consultarlos más adelante.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <Link
                            href="/usuario/panel"
                            class="rounded-full bg-gray-900 px-5 py-3 text-sm font-bold text-white shadow transition hover:bg-black"
                        >
                            Volver al panel
                        </Link>

                        <Link
                            href="/destinos"
                            class="rounded-full bg-[#0b6fb3] px-5 py-3 text-sm font-bold text-white shadow transition hover:bg-blue-700"
                        >
                            Explorar más
                        </Link>
                    </div>
                </div>
            </section>

            <section
                v-if="favoritos.length > 0"
                class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3"
            >
                <article
                    v-for="favorito in favoritos"
                    :key="favorito.id"
                    class="overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-xl"
                >
                    <img
                        :src="obtenerImagenDestino(favorito.destino)"
                        :alt="favorito.destino.nombre"
                        class="h-56 w-full object-cover"
                    >

                    <div class="p-6">
                        <p class="text-sm font-bold text-[#168a1a]">
                            {{ favorito.destino.categoria?.nombre ?? 'Sin categoría' }}
                        </p>

                        <h2 class="mt-2 text-2xl font-black text-gray-900">
                            {{ favorito.destino.nombre }}
                        </h2>

                        <p class="mt-2 text-sm font-semibold text-gray-500">
                            {{ favorito.destino.departamento ?? favorito.destino.ubicacion ?? 'El Salvador' }}
                            <span v-if="favorito.destino.municipio">
                                · {{ favorito.destino.municipio }}
                            </span>
                        </p>

                        <p class="mt-4 line-clamp-3 leading-7 text-gray-600">
                            {{ favorito.destino.descripcion }}
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <Link
                                :href="`/destinos/${favorito.destino.id}`"
                                class="rounded-full bg-[#0b6fb3] px-4 py-2 text-sm font-bold text-white shadow transition hover:bg-[#168a1a]"
                            >
                                Ver destino
                            </Link>

                            <button
                                @click="eliminarFavorito(favorito.destino.id)"
                                class="rounded-full bg-red-600 px-4 py-2 text-sm font-bold text-white shadow transition hover:bg-red-700"
                            >
                                Quitar
                            </button>
                        </div>
                    </div>
                </article>
            </section>

            <section
                v-else
                class="mt-8 rounded-3xl bg-white p-10 text-center shadow-lg ring-1 ring-slate-100"
            >
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 text-4xl">
                    🌎
                </div>

                <h2 class="mt-6 text-3xl font-black text-gray-900">
                    Todavía no tienes favoritos
                </h2>

                <p class="mx-auto mt-3 max-w-2xl leading-8 text-gray-600">
                    Explora los destinos turísticos disponibles y guarda los que más te interesen.
                    Así podrás consultarlos fácilmente desde tu panel.
                </p>

                <Link
                    href="/destinos"
                    class="mt-6 inline-flex rounded-full bg-[#168a1a] px-6 py-3 font-bold text-white shadow transition hover:bg-green-700"
                >
                    Explorar destinos
                </Link>
            </section>
        </main>
    </div>
</template>