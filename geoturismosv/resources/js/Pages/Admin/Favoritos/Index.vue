<script setup>
import { Link, router } from '@inertiajs/vue3';
import UserNavbar from '@/Components/UserNavbar.vue';

defineProps({
    favoritos: Array,
});

const eliminarFavorito = (destinoId) => {
    if (confirm('¿Deseas eliminar este destino de tus favoritos?')) {
        router.delete(`/favoritos/${destinoId}`);
    }
};
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <UserNavbar />

        <main class="mx-auto max-w-7xl px-6 py-10">
            <section class="mb-8 rounded-xl bg-white p-8 shadow">
                <h1 class="text-3xl font-bold text-gray-900">
                    Mis destinos favoritos
                </h1>

                <p class="mt-2 text-gray-600">
                    Aquí encontrarás los destinos turísticos que has guardado para visitar o consultar más tarde.
                </p>
            </section>

            <section v-if="favoritos.length === 0" class="rounded-xl bg-yellow-50 p-8 text-yellow-800 shadow">
                <h2 class="text-xl font-bold">Aún no tienes destinos favoritos</h2>
                <p class="mt-2">
                    Explora los destinos disponibles y guarda los lugares que más te interesen.
                </p>

                <Link
                    href="/destinos"
                    class="mt-5 inline-block rounded-full bg-[#0b6fb3] px-5 py-3 font-semibold text-white shadow hover:bg-[#168a1a]"
                >
                    Explorar destinos
                </Link>
            </section>

            <section v-else class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <article
                    v-for="favorito in favoritos"
                    :key="favorito.id"
                    class="overflow-hidden rounded-xl bg-white shadow transition hover:-translate-y-1 hover:shadow-lg"
                >
                    <img
                        :src="favorito.destino.imagen ? '/' + favorito.destino.imagen : '/img/logo-geoturismosv.png'"
                        :alt="favorito.destino.nombre"
                        class="h-48 w-full object-cover"
                    >

                    <div class="p-5">
                        <p class="text-sm font-semibold text-[#168a1a]">
                            {{ favorito.destino.categoria?.nombre }}
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-gray-900">
                            {{ favorito.destino.nombre }}
                        </h2>

                        <p class="mt-2 text-sm text-gray-600">
                            {{ favorito.destino.departamento ?? favorito.destino.ubicacion }}
                        </p>

                        <p class="mt-3 line-clamp-3 text-gray-700">
                            {{ favorito.destino.descripcion }}
                        </p>

                        <div class="mt-5 flex gap-2">
                            <Link
                                :href="`/destinos/${favorito.destino.id}`"
                                class="rounded-full bg-[#0b6fb3] px-4 py-2 text-sm font-semibold text-white hover:bg-[#168a1a]"
                            >
                                Ver destino
                            </Link>

                            <button
                                @click="eliminarFavorito(favorito.destino.id)"
                                class="rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700"
                            >
                                Eliminar
                            </button>
                        </div>
                    </div>
                </article>
            </section>
        </main>
    </div>
</template>