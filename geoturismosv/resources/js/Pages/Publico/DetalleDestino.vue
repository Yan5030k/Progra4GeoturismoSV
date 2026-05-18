<script setup>
import { Link, router } from '@inertiajs/vue3';
import PublicNavbar from '@/Components/PublicNavbar.vue';

const props = defineProps({
    destino: Object,
    esFavorito: Boolean,
    usuarioLogueado: Boolean,
});

const guardarFavorito = () => {
    router.post(`/favoritos/${props.destino.id}`, {}, {
        preserveScroll: true,
    });
};

const eliminarFavorito = () => {
    router.delete(`/favoritos/${props.destino.id}`, {
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <PublicNavbar />

        <main class="mx-auto max-w-5xl px-6 py-10">
            <Link href="/destinos" class="font-semibold text-[#0b6fb3] hover:text-[#168a1a]">
                ← Volver a destinos
            </Link>

            <article class="mt-6 overflow-hidden rounded-xl bg-white shadow-lg">
                <img
                    :src="'/' + destino.imagen"
                    :alt="destino.nombre"
                    class="h-96 w-full object-cover"
                >

                <div class="p-8">
                    <p class="font-semibold text-[#168a1a]">
                        {{ destino.categoria?.nombre }}
                    </p>

                    <h1 class="mt-2 text-4xl font-bold text-gray-900">
                        {{ destino.nombre }}
                    </h1>

                    <p class="mt-2 text-gray-600">{{ destino.ubicacion }}</p>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div class="rounded-xl bg-blue-50 p-4">
                            <strong class="text-[#0b6fb3]">Costo estimado</strong>
                            <p class="mt-1 text-gray-700">${{ destino.costo_estimado }}</p>
                        </div>

                        <div class="rounded-xl bg-green-50 p-4">
                            <strong class="text-[#168a1a]">Horario de atención</strong>

                            <p class="mt-1 text-gray-700">
                                {{ destino.dias_atencion ?? destino.horario ?? 'Horario no especificado' }}
                            </p>

                            <p class="text-gray-700">
                                <span v-if="destino.hora_apertura && destino.hora_cierre">
                                    {{ destino.hora_apertura }} - {{ destino.hora_cierre }}
                                </span>

                                <span v-else>
                                    Hora no especificada
                                </span>
                            </p>
                        </div>

                        <div class="rounded-xl bg-orange-50 p-4">
                            <strong class="text-[#f4a000]">Estado</strong>
                            <p class="mt-1 text-gray-700">
                                {{ destino.estado ? 'Disponible' : 'No disponible' }}
                            </p>
                        </div>
                    </div>

                    <section class="mt-8">
                        <h2 class="text-2xl font-bold text-gray-900">Descripción</h2>
                        <p class="mt-2 leading-relaxed text-gray-700">
                            {{ destino.descripcion }}
                        </p>
                    </section>

                    <section class="mt-6">
                        <h2 class="text-2xl font-bold text-gray-900">Ubicación</h2>

                        <div class="mt-3 grid gap-4 md:grid-cols-2">
                            <div class="rounded-xl bg-blue-50 p-4">
                                <strong class="text-[#0b6fb3]">Departamento</strong>
                                <p class="mt-1 text-gray-700">
                                    {{ destino.departamento ?? 'No especificado' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-green-50 p-4">
                                <strong class="text-[#168a1a]">Municipio o distrito</strong>
                                <p class="mt-1 text-gray-700">
                                    {{ destino.municipio ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 rounded-xl bg-slate-100 p-4">
                            <strong class="text-gray-900">Dirección o referencia</strong>
                            <p class="mt-1 leading-relaxed text-gray-700">
                                {{ destino.direccion ?? 'No especificada' }}
                            </p>
                        </div>

                        <div v-if="destino.latitud && destino.longitud" class="mt-6 flex justify-start">
                            <a
                                :href="`https://www.google.com/maps/dir/?api=1&destination=${destino.latitud},${destino.longitud}`"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 rounded-xl bg-[#4285F4] px-6 py-3 font-semibold text-white shadow-md transition-transform hover:scale-105 hover:bg-[#3367D6]"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                                Cómo llegar en Google Maps
                            </a>
                        </div>
                    </section>

                    <section class="mt-6">
                        <h2 class="text-2xl font-bold text-gray-900">Recomendaciones</h2>
                        <p class="mt-2 leading-relaxed text-gray-700">
                            {{ destino.recomendaciones }}
                        </p>
                    </section>

                    <div v-if="usuarioLogueado" class="mt-8 rounded-xl bg-slate-100 p-5">
                        <h2 class="text-xl font-bold text-gray-900">
                            ¿Te interesa este destino?
                        </h2>

                        <p class="mt-1 text-gray-600">
                            Guárdalo en favoritos para consultarlo más tarde desde tu panel de usuario.
                        </p>

                        <button
                            v-if="!esFavorito"
                            @click="guardarFavorito"
                            class="mt-4 rounded-full bg-[#168a1a] px-5 py-3 font-semibold text-white shadow transition hover:bg-green-700"
                        >
                            Guardar en favoritos
                        </button>

                        <button
                            v-else
                            @click="eliminarFavorito"
                            class="mt-4 rounded-full bg-red-600 px-5 py-3 font-semibold text-white shadow transition hover:bg-red-700"
                        >
                            Eliminar de favoritos
                        </button>
                    </div>

                    <div v-else class="mt-8 rounded-xl border border-yellow-200 bg-yellow-50 p-5 text-yellow-800">
                        <h2 class="font-bold">Inicia sesión para guardar favoritos</h2>
                        <p class="mt-1">
                            Crea una cuenta o inicia sesión para guardar este destino dentro de tus favoritos.
                        </p>

                        <Link
                            href="/login"
                            class="mt-4 inline-block rounded-full bg-[#f4a000] px-5 py-2 font-semibold text-white shadow hover:bg-orange-500"
                        >
                            Iniciar sesión
                        </Link>
                    </div>
                </div>
            </article>
        </main>
    </div>
</template>