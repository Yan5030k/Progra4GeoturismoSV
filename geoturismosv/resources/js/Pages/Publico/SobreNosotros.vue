<script setup>
import PublicNavbar from '@/Components/PublicNavbar.vue';
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <PublicNavbar />

        
        <section class="relative bg-gray-900 py-20 sm:py-28 overflow-hidden">
            <div class="absolute inset-0">
                
                <img src="/images/playa_hero.png" alt="Playa de El Salvador al atardecer" class="h-full w-full object-cover opacity-30">
            </div>
            <div class="relative mx-auto max-w-5xl px-6 text-center">
                <h1 class="text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl drop-shadow-lg">
                    Sobre GeoTurismoSV
                </h1>
                <p class="mt-4 text-lg text-gray-200 sm:text-xl font-medium drop-shadow-md">
                    Descubre la iniciativa detrás de nuestra plataforma
                </p>
            </div>
        </section>

        
        <main class="relative z-10 mx-auto max-w-4xl px-6 pb-16 -mt-12 sm:-mt-16">
            <section class="overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5">
                
                <div class="h-2 bg-gradient-to-r from-[#0b6fb3] via-[#1690c8] to-[#168a1a]"></div>

                <div class="p-8 sm:p-12">
                    <div class="space-y-6 text-lg leading-relaxed text-gray-700">
                        <p>
                            <strong class="font-bold text-gray-900">GeoTurismoSV</strong> nace de la pasión por nuestra tierra. Somos una iniciativa salvadoreña dedicada a mostrar la auténtica belleza, los paisajes y la riqueza cultural de El Salvador.
                        </p>

                        <p>
                            Creemos que planear tu viaje no debería ser complicado. Por eso, hemos creado una plataforma que resuelve el problema de la información turística dispersa: centralizamos los mejores destinos, rincones mágicos y recomendaciones en un sistema ordenado, accesible e intuitivo.
                        </p>

                        <p>
                            Nuestra misión es simple: ser la brújula que te inspire y te guíe hacia tu próxima gran aventura dentro del "Pulgarcito de América", ayudándote a descubrir los destinos, la cultura y las experiencias únicas que hacen de El Salvador un lugar inolvidable.
                        </p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>