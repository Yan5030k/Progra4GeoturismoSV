<script setup>
import { Link } from '@inertiajs/vue3';
import PublicNavbar from '@/Components/PublicNavbar.vue';

defineProps({
    destinos: Array,
});
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <PublicNavbar />

        <main>
            <section class="bg-white py-16">
                <div class="mx-auto max-w-7xl px-6">
                    <h2 class="mb-4 text-4xl font-bold text-gray-900">
                        Descubrí El Salvador de una forma diferente
                    </h2>
                    <p class="max-w-3xl text-lg text-gray-600">
                        GeoTurismoSV centraliza destinos turísticos, recomendaciones y categorías
                        para ayudarte a elegir tu próxima experiencia dentro del país.
                    </p>

                    <div class="mt-8 flex gap-4">
                        <Link href="/destinos" class="rounded bg-[#168a1a] px-5 py-3 font-semibold text-white shadow hover:bg-green-700">
                            Explorar destinos
                        </Link>

                        <Link href="/register" class="rounded border border-[#0b6fb3] px-5 py-3 font-semibold text-[#0b6fb3] hover:bg-blue-50">
                            Crear cuenta
                        </Link>
                    </div>
                </div>
            </section>

            <section class="py-12">
                <div class="mx-auto max-w-7xl px-6">
                    <h3 class="mb-6 text-2xl font-bold text-gray-900">
                        Destinos destacados
                    </h3>

                    <div class="grid gap-6 md:grid-cols-3">
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
                                <p class="text-sm font-semibold text-[#168a1a]">
                                    {{ destino.categoria?.nombre }}
                                </p>
                                <h4 class="mt-1 text-xl font-bold">
                                    {{ destino.nombre }}
                                </h4>
                                <p class="mt-2 text-sm text-gray-600">
                                    {{ destino.ubicacion }}
                                </p>
                                <Link
                                    :href="`/destinos/${destino.id}`"
                                    class="mt-4 inline-block text-[#0b6fb3] hover:underline"
                                >
                                    Ver detalle
                                </Link>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>