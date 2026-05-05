<script setup>
import { Link } from '@inertiajs/vue3';
import PublicNavbar from '@/Components/PublicNavbar.vue';

defineProps({
    destinos: Array,
    categorias: Array,
});
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <PublicNavbar />

        <main class="mx-auto max-w-7xl px-6 py-10">
            <h1 class="text-3xl font-bold text-gray-900">Destinos turísticos</h1>
            <p class="mt-2 text-gray-600">
                Explorá lugares turísticos organizados por categoría y ubicación.
            </p>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <article
                    v-for="destino in destinos"
                    :key="destino.id"
                    class="overflow-hidden rounded-xl bg-white shadow transition hover:-translate-y-1 hover:shadow-lg"
                >
                    <img
                        :src="'/' + destino.imagen"
                        :alt="destino.nombre"
                        class="h-48 w-full object-cover"
                    >

                    <div class="p-5">
                        <p class="text-sm font-semibold text-[#168a1a]">
                            {{ destino.categoria?.nombre }}
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-gray-900">
                            {{ destino.nombre }}
                        </h2>

                        <p class="mt-2 text-sm text-gray-600">
                            {{ destino.ubicacion }}
                        </p>

                        <p class="mt-3 text-gray-700">
                            {{ destino.descripcion.substring(0, 120) }}...
                        </p>

                        <Link
                            :href="`/destinos/${destino.id}`"
                            class="mt-4 inline-block rounded-full bg-[#0b6fb3] px-4 py-2 font-semibold text-white shadow transition hover:bg-[#168a1a]"
                        >
                            Ver detalle
                        </Link>
                    </div>
                </article>
            </div>
        </main>
    </div>
</template>