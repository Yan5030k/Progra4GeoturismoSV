<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    destinos: Array,
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
                    <Link href="/categorias">Categorías</Link>
                    <Link href="/login" class="rounded bg-white px-4 py-2 text-emerald-700">
                        Iniciar sesión
                    </Link>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-10">
            <h1 class="text-3xl font-bold text-gray-900">Destinos turísticos</h1>
            <p class="mt-2 text-gray-600">
                Explorá lugares turísticos organizados por categoría y ubicación.
            </p>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <article
                    v-for="destino in destinos"
                    :key="destino.id"
                    class="overflow-hidden rounded-lg bg-white shadow"
                >
                    <img
                        :src="'/' + destino.imagen"
                        :alt="destino.nombre"
                        class="h-48 w-full object-cover"
                    >

                    <div class="p-5">
                        <p class="text-sm font-semibold text-emerald-700">
                            {{ destino.categoria?.nombre }}
                        </p>
                        <h2 class="mt-1 text-xl font-bold">{{ destino.nombre }}</h2>
                        <p class="mt-2 text-sm text-gray-600">{{ destino.ubicacion }}</p>
                        <p class="mt-3 text-gray-700">
                            {{ destino.descripcion.substring(0, 120) }}...
                        </p>

                        <Link
                            :href="`/destinos/${destino.id}`"
                            class="mt-4 inline-block rounded bg-emerald-700 px-4 py-2 text-white"
                        >
                            Ver detalle
                        </Link>
                    </div>
                </article>
            </div>
        </main>
    </div>
</template>