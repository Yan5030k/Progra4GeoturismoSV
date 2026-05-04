<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    categorias: Array,
});
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <header class="bg-[#0b6fb3] text-white shadow">
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <Link href="/" class="flex items-center gap-3">
                    <img
                        src="/img/logo-geoturismosv.png"
                        alt="Logo GeoTurismoSV"
                        class="h-12 w-auto rounded bg-white px-2 py-1"
                    >
                </Link>
                <div class="flex gap-4">
                    <Link href="/">Inicio</Link>
                    <Link href="/destinos">Destinos</Link>
                    <Link href="/login">Iniciar sesión</Link>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-10">
            <h1 class="text-3xl font-bold text-gray-900">Categorías turísticas</h1>
            <p class="mt-2 text-gray-600">
                Los destinos se organizan por tipo de experiencia turística.
            </p>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <article
                    v-for="categoria in categorias"
                    :key="categoria.id"
                    class="rounded-lg bg-white p-6 shadow"
                >
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ categoria.nombre }}
                    </h2>

                    <p class="mt-3 text-gray-600">
                        {{ categoria.descripcion }}
                    </p>

                    <p class="mt-4 text-sm font-semibold text-emerald-700">
                        {{ categoria.destinos_count }} destinos registrados
                    </p>
                </article>
            </div>
        </main>
    </div>
</template>