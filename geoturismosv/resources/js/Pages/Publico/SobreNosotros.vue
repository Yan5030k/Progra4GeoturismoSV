<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <header class="bg-emerald-700 text-white">
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <Link href="/" class="text-2xl font-bold">GeoTurismoSV</Link>
                <div class="flex gap-4">
                    <Link href="/">Inicio</Link>
                    <Link href="/destinos">Destinos</Link>
                    <Link href="/categorias">Categorías</Link>
                    <Link href="/login">Iniciar sesión</Link>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-5xl px-6 py-10">
            <section class="rounded-lg bg-white p-8 shadow">
                <h1 class="text-3xl font-bold text-gray-900">Sobre GeoTurismoSV</h1>

                <p class="mt-4 text-gray-700">
                    GeoTurismoSV es una empresa ficticia salvadoreña dedicada a la
                    promoción turística digital de El Salvador.
                </p>

                <p class="mt-4 text-gray-700">
                    La plataforma busca resolver el problema de la información turística
                    dispersa, centralizando destinos, categorías y recomendaciones en un
                    sistema web ordenado, accesible e intuitivo.
                </p>

                <p class="mt-4 text-gray-700">
                    Nuestro lema es:
                    <strong>“Donde cada lugar cuenta una historia”.</strong>
                </p>
            </section>
        </main>
    </div>
</template>