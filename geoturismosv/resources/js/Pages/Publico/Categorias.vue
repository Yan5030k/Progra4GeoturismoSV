<script setup>
import PublicNavbar from '@/Components/PublicNavbar.vue';

defineProps({
    categorias: Array,
});
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <PublicNavbar />

        <main class="mx-auto max-w-7xl px-6 py-10">
            <h1 class="text-3xl font-bold text-gray-900">Categorías turísticas</h1>
            <p class="mt-2 text-gray-600">
                Los destinos se organizan por tipo de experiencia turística.
            </p>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <article
                    v-for="categoria in categorias"
                    :key="categoria.id"
                    class="rounded-xl border border-blue-100 bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-lg"
                >
                    <div class="mb-4 h-2 w-20 rounded-full bg-gradient-to-r from-[#0b6fb3] to-[#168a1a]"></div>

                    <h2 class="text-xl font-bold text-gray-900">
                        {{ categoria.nombre }}
                    </h2>

                    <p class="mt-3 text-gray-600">
                        {{ categoria.descripcion }}
                    </p>

                    <p class="mt-4 inline-block rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-[#0b6fb3]">
                        {{ categoria.destinos_count }} destinos registrados
                    </p>
                </article>
            </div>
        </main>
    </div>
</template>