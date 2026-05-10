<script setup>
import UserNavbar from '@/Components/UserNavbar.vue';

defineProps({
    favoritos: Array,
});
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <UserNavbar />

        <main class="mx-auto max-w-7xl px-6 py-10">
            <section class="rounded-xl bg-white p-8 shadow">
                <h1 class="text-3xl font-bold text-gray-900">
                    Panel del usuario
                </h1>

                <p class="mt-2 text-gray-600">
                    Desde este panel podés consultar tus destinos favoritos y seguir explorando
                    lugares turísticos de El Salvador.
                </p>
            </section>

            <section class="mt-8">
                <h2 class="text-2xl font-bold text-gray-900">Tus favoritos recientes</h2>

                <div v-if="favoritos.length === 0" class="mt-4 rounded-xl bg-yellow-50 p-6 text-yellow-800">
                    Todavía no has guardado destinos favoritos.
                </div>

                <div v-else class="mt-6 grid gap-6 md:grid-cols-3">
                    <article
                        v-for="favorito in favoritos"
                        :key="favorito.id"
                        class="overflow-hidden rounded-xl bg-white shadow"
                    >
                        <img
                            :src="'/' + favorito.destino.imagen"
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
                                {{ favorito.destino.ubicacion }}
                            </p>

                            <a
                                :href="`/destinos/${favorito.destino.id}`"
                                class="mt-4 inline-block rounded-full bg-[#0b6fb3] px-4 py-2 font-semibold text-white hover:bg-[#168a1a]"
                            >
                                Ver destino
                            </a>
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</template>