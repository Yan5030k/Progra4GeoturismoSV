<script setup>
import { Link } from '@inertiajs/vue3';
import UserNavbar from '@/Components/UserNavbar.vue';

defineProps({
    favoritosRecientes: Array,
    totalFavoritos: Number,
    totalDestinos: Number,
});
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <UserNavbar />

        <main class="mx-auto max-w-7xl px-6 py-10">
            <section class="rounded-xl bg-white p-8 shadow">
                <h1 class="text-3xl font-bold text-gray-900">
                    Bienvenido a tu panel turístico
                </h1>

                <p class="mt-2 text-gray-600">
                    Desde aquí podés explorar destinos turísticos de El Salvador, consultar tus lugares favoritos
                    y descubrir nuevas opciones para visitar.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <Link
                        href="/destinos"
                        class="rounded-full bg-[#0b6fb3] px-5 py-3 font-semibold text-white shadow hover:bg-blue-700"
                    >
                        Explorar destinos
                    </Link>

                    <Link
                        href="/favoritos"
                        class="rounded-full bg-[#168a1a] px-5 py-3 font-semibold text-white shadow hover:bg-green-700"
                    >
                        Ver mis favoritos
                    </Link>
                </div>
            </section>

            <section class="mt-8 grid gap-6 md:grid-cols-2">
                <article class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm font-semibold text-[#0b6fb3]">
                        Destinos disponibles
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-gray-900">
                        {{ totalDestinos }}
                    </h2>

                    <p class="mt-2 text-gray-600">
                        Lugares turísticos activos dentro de la plataforma.
                    </p>
                </article>

                <article class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm font-semibold text-[#168a1a]">
                        Tus favoritos
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-gray-900">
                        {{ totalFavoritos }}
                    </h2>

                    <p class="mt-2 text-gray-600">
                        Destinos que has guardado para consultar más tarde.
                    </p>
                </article>
            </section>

            <section class="mt-10">
                <div class="mb-5 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">
                            Favoritos recientes
                        </h2>

                        <p class="mt-1 text-gray-600">
                            Últimos destinos que guardaste en tu cuenta.
                        </p>
                    </div>

                    <Link
                        href="/favoritos"
                        class="font-semibold text-[#0b6fb3] hover:text-[#168a1a]"
                    >
                        Ver todos →
                    </Link>
                </div>

                <div
                    v-if="favoritosRecientes.length === 0"
                    class="rounded-xl bg-yellow-50 p-6 text-yellow-800 shadow"
                >
                    Todavía no has guardado destinos favoritos.
                    <Link href="/destinos" class="font-semibold underline">
                        Explora destinos para agregar algunos.
                    </Link>
                </div>

                <div v-else class="grid gap-6 md:grid-cols-3">
                    <article
                        v-for="favorito in favoritosRecientes"
                        :key="favorito.id"
                        class="overflow-hidden rounded-xl bg-white shadow"
                    >
                        <img
                            :src="favorito.destino.imagen ? '/' + favorito.destino.imagen : '/img/logo-geoturismosv.png'"
                            :alt="favorito.destino.nombre"
                            class="h-44 w-full object-cover"
                        >

                        <div class="p-5">
                            <p class="text-sm font-semibold text-[#168a1a]">
                                {{ favorito.destino.categoria?.nombre }}
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900">
                                {{ favorito.destino.nombre }}
                            </h3>

                            <p class="mt-2 text-gray-600">
                                {{ favorito.destino.departamento ?? favorito.destino.ubicacion }}
                            </p>

                            <Link
                                :href="`/destinos/${favorito.destino.id}`"
                                class="mt-4 inline-block rounded-full bg-[#0b6fb3] px-4 py-2 font-semibold text-white hover:bg-[#168a1a]"
                            >
                                Ver destino
                            </Link>
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</template>