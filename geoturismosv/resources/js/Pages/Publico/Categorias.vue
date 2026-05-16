<script setup>
import PublicNavbar from '@/Components/PublicNavbar.vue';

defineProps({
    categorias: Array,
});

</script>

<template>
    <div class="min-h-screen bg-slate-50 selection:bg-[#0b6fb3] selection:text-white pb-20">
        <PublicNavbar />

        <!-- Header Section -->
        <div class="relative overflow-hidden bg-white py-16 sm:py-24 lg:py-32 border-b border-gray-100">
            <div class="absolute inset-0 z-0 opacity-40">
                <div class="absolute left-0 top-0 h-full w-1/2 bg-gradient-to-r from-white to-transparent"></div>
                <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-l from-white to-transparent"></div>
                <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-white to-transparent"></div>
            </div>
            
            <div class="relative z-10 mx-auto max-w-7xl px-6 text-center lg:px-8">
                <div class="mx-auto max-w-2xl">
                    <h2 class="text-sm font-bold leading-7 text-[#0b6fb3] uppercase tracking-widest">Explora El Salvador</h2>
                    <h1 class="mt-2 text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                        Categorías <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0b6fb3] to-[#168a1a]">Turísticas</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Descubre la riqueza y diversidad de nuestros destinos. Están organizados por tipo de experiencia turística para ayudarte a encontrar tu próxima aventura.
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="mx-auto max-w-7xl px-6 py-12 lg:px-8 -mt-10 relative z-20">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <article
                    v-for="categoria in categorias"
                    :key="categoria.id"
                    class="group relative flex flex-col justify-between overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:shadow-blue-500/10 hover:ring-blue-200"
                >
                    <!-- Decorative Gradient Background on Hover -->
                    <div class="absolute -inset-px bg-gradient-to-br from-[#0b6fb3]/5 to-[#168a1a]/5 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                    
                    <div class="relative p-8 flex-1 flex flex-col">
                        <!-- Icon / Graphic Element -->
                        <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-blue-50 text-[#0b6fb3] ring-1 ring-inset ring-blue-500/10 transition-colors duration-300 group-hover:bg-[#0b6fb3] group-hover:text-white shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                        </div>
                        
                        <h2 class="text-xl font-bold tracking-tight text-gray-900 group-hover:text-[#0b6fb3] transition-colors duration-300">
                            {{ categoria.nombre }}
                        </h2>
                        
                        <p class="mt-4 text-base leading-relaxed text-gray-600 flex-1">
                            {{ categoria.descripcion }}
                        </p>
                    </div>

                    <div class="relative border-t border-gray-100 bg-gray-50/50 px-8 py-4 transition-colors duration-300 group-hover:bg-blue-50/50 flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white px-3 py-1 text-xs font-semibold text-[#168a1a] shadow-sm ring-1 ring-inset ring-gray-200 transition-colors duration-300 group-hover:ring-[#168a1a]/30">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#168a1a]"></span>
                            {{ categoria.destinos_count }} destinos
                        </span>
                        
                        <span class="text-sm font-medium text-[#0b6fb3] flex items-center gap-1 group-hover:translate-x-1 transition-transform duration-300 cursor-pointer">
                            Explorar
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                </article>
            </div>
            
            <!-- Empty State -->
            <div v-if="!categorias || categorias.length === 0" class="text-center py-20 rounded-2xl bg-white border border-dashed border-gray-300 mt-8">
                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay categorías</h3>
                <p class="mt-1 text-sm text-gray-500">Aún no se han registrado categorías turísticas en la plataforma.</p>
            </div>
        </main>
    </div>
</template>