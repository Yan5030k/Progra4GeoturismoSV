<script setup>
import { computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import PublicNavbar from '@/Components/PublicNavbar.vue';

const props = defineProps({
    destino: Object,
    esFavorito: Boolean,
});

const page = usePage();

const usuarioAutenticado = computed(() => {
    return page.props.auth?.user ?? null;
});

const guardarFavorito = () => {
    router.post(`/favoritos/${props.destino.id}`);
};

const eliminarFavorito = () => {
    router.delete(`/favoritos/${props.destino.id}`);
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
                            <strong class="text-[#168a1a]">Horario</strong>
                            <p class="mt-1 text-gray-700">{{ destino.horario }}</p>
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
                        <h2 class="text-2xl font-bold text-gray-900">Dirección o referencia</h2>
                        <p class="mt-2 leading-relaxed text-gray-700">
                            {{ destino.direccion }}
                        </p>
                    </section>

                    <section class="mt-6">
                        <h2 class="text-2xl font-bold text-gray-900">Recomendaciones</h2>
                        <p class="mt-2 leading-relaxed text-gray-700">
                            {{ destino.recomendaciones }}
                        </p>
                    </section>

                    <div v-if="usuarioAutenticado" class="mt-8">
                        <button
                            v-if="!esFavorito"
                            @click="guardarFavorito"
                            class="rounded-full bg-[#168a1a] px-5 py-3 font-semibold text-white shadow transition hover:bg-green-700"
                        >
                            Guardar en favoritos
                        </button>

                        <button
                            v-else
                            @click="eliminarFavorito"
                            class="rounded-full bg-red-600 px-5 py-3 font-semibold text-white shadow transition hover:bg-red-700"
                        >
                            Eliminar de favoritos
                        </button>
                    </div>

                    <div v-else class="mt-8 rounded-xl border border-yellow-200 bg-yellow-50 p-4 text-yellow-800">
                        Iniciá sesión para guardar este destino en favoritos.
                    </div>
                </div>
            </article>
        </main>
    </div>
</template>