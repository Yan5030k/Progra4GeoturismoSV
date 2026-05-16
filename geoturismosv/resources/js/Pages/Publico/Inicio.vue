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
            <section class="relative bg-gray-900 py-24 lg:py-32 overflow-hidden">
                <div class="absolute inset-0">
                    <img src="/images/hero.png" alt="Paisaje El Salvador" class="h-full w-full object-cover opacity-40">
                </div>
                <div class="relative mx-auto max-w-7xl px-6 text-center lg:text-left">
                    <h2 class="mb-4 text-5xl font-black tracking-tight text-white sm:text-6xl lg:text-7xl">
                        Donde cada lugar <br class="hidden lg:block"/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#168a1a] to-green-400">
                            cuenta una historia
                        </span>
                    </h2>
                    <p class="mx-auto lg:mx-0 max-w-2xl text-lg text-gray-300 sm:text-xl leading-relaxed">
                        <strong class="font-semibold text-white">Descubrí El Salvador de una forma diferente.</strong> 
                        GeoTurismoSV centraliza destinos turísticos, recomendaciones y categorías para ayudarte a elegir tu próxima experiencia.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <Link href="/destinos" class="rounded-full bg-gradient-to-r from-[#168a1a] to-green-500 px-8 py-4 font-bold text-white shadow-lg transition-transform duration-300 hover:scale-105 hover:shadow-green-500/30">
                            Explorar destinos
                        </Link>

                        <Link href="/register" class="rounded-full border-2 border-white/80 bg-white/10 px-8 py-4 font-bold text-white backdrop-blur-sm transition-all duration-300 hover:bg-white hover:text-gray-900">
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
                            class="group overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-xl"
                        >
                            <div class="overflow-hidden">
                                <img
                                    :src="'/' + destino.imagen"
                                    :alt="destino.nombre"
                                    class="h-56 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                >
                            </div>

                            <div class="p-6">
                                <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#168a1a]">
                                    {{ destino.categoria?.nombre }}
                                </span>
                                <h4 class="mt-3 text-2xl font-bold text-gray-900 group-hover:text-[#0b6fb3] transition-colors">
                                    {{ destino.nombre }}
                                </h4>
                                <p class="mt-2 text-sm text-gray-500 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ destino.ubicacion }}
                                </p>
                                <Link
                                    :href="`/destinos/${destino.id}`"
                                    class="mt-5 inline-flex items-center font-semibold text-[#0b6fb3] hover:underline"
                                >
                                    Ver detalle
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </Link>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-gray-900 py-8 text-center text-gray-400">
            <div class="mx-auto max-w-7xl px-6">
                <p>&copy; 2026 GeoTurismoSV. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</template>