<script setup>
import PublicNavbar from '@/Components/PublicNavbar.vue';
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <PublicNavbar />

        <main class="mx-auto max-w-5xl px-6 py-10">
            <section class="overflow-hidden rounded-xl bg-white shadow-lg">
                <div class="h-3 bg-gradient-to-r from-[#0b6fb3] via-[#1690c8] to-[#168a1a]"></div>

                <div class="p-8">
                    <h1 class="text-3xl font-bold text-gray-900">Sobre GeoTurismoSV</h1>

                    <p class="mt-4 leading-relaxed text-gray-700">
                        GeoTurismoSV es una empresa ficticia salvadoreña dedicada a la
                        promoción turística digital de El Salvador.
                    </p>

                    <p class="mt-4 leading-relaxed text-gray-700">
                        La plataforma busca resolver el problema de la información turística
                        dispersa, centralizando destinos, categorías y recomendaciones en un
                        sistema web ordenado, accesible e intuitivo.
                    </p>

                    <div class="mt-6 rounded-xl bg-blue-50 p-6">
                        <p class="text-lg text-gray-700">
                            Nuestro lema es:
                            <strong class="text-[#0b6fb3]">
                                “Donde cada lugar cuenta una historia”.
                            </strong>
                        </p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>