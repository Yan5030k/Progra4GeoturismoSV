<script setup>
import { Link, usePage, router } from '@inertiajs/vue3';

const props = defineProps({
    destino: Object,
    esFavorito: Boolean,
});

const page = usePage();

const guardarFavorito = () => {
    router.post(`/favoritos/${props.destino.id}`);
};

const eliminarFavorito = () => {
    router.delete(`/favoritos/${props.destino.id}`);
};
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <header class="bg-emerald-700 text-white">
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <Link href="/" class="text-2xl font-bold">GeoTurismoSV</Link>
                <div class="flex gap-4">
                    <Link href="/destinos">Destinos</Link>
                    <Link href="/login">Iniciar sesión</Link>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-5xl px-6 py-10">
            <Link href="/destinos" class="text-emerald-700 hover:underline">
                ← Volver a destinos
            </Link>

            <article class="mt-6 overflow-hidden rounded-lg bg-white shadow">
                <img
                    :src="'/' + destino.imagen"
                    :alt="destino.nombre"
                    class="h-96 w-full object-cover"
                >

                <div class="p-8">
                    <p class="font-semibold text-emerald-700">
                        {{ destino.categoria?.nombre }}
                    </p>

                    <h1 class="mt-2 text-4xl font-bold text-gray-900">
                        {{ destino.nombre }}
                    </h1>

                    <p class="mt-2 text-gray-600">{{ destino.ubicacion }}</p>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div class="rounded bg-gray-100 p-4">
                            <strong>Costo estimado</strong>
                            <p>${{ destino.costo_estimado }}</p>
                        </div>

                        <div class="rounded bg-gray-100 p-4">
                            <strong>Horario</strong>
                            <p>{{ destino.horario }}</p>
                        </div>

                        <div class="rounded bg-gray-100 p-4">
                            <strong>Estado</strong>
                            <p>{{ destino.estado ? 'Disponible' : 'No disponible' }}</p>
                        </div>
                    </div>

                    <section class="mt-8">
                        <h2 class="text-2xl font-bold">Descripción</h2>
                        <p class="mt-2 text-gray-700">{{ destino.descripcion }}</p>
                    </section>

                    <section class="mt-6">
                        <h2 class="text-2xl font-bold">Dirección o referencia</h2>
                        <p class="mt-2 text-gray-700">{{ destino.direccion }}</p>
                    </section>

                    <section class="mt-6">
                        <h2 class="text-2xl font-bold">Recomendaciones</h2>
                        <p class="mt-2 text-gray-700">{{ destino.recomendaciones }}</p>
                    </section>

                    <div v-if="page.props.auth.user" class="mt-8">
                        <button
                            v-if="!esFavorito"
                            @click="guardarFavorito"
                            class="rounded bg-emerald-700 px-5 py-3 text-white"
                        >
                            Guardar en favoritos
                        </button>

                        <button
                            v-else
                            @click="eliminarFavorito"
                            class="rounded bg-red-600 px-5 py-3 text-white"
                        >
                            Eliminar de favoritos
                        </button>
                    </div>

                    <div v-else class="mt-8 rounded bg-yellow-100 p-4 text-yellow-800">
                        Iniciá sesión para guardar este destino en favoritos.
                    </div>
                </div>
            </article>
        </main>
    </div>
</template>