<script setup>
import AdminNavbar from '@/Components/AdminNavbar.vue';

defineProps({
    totalUsuarios: Number,
    totalCategorias: Number,
    totalDestinos: Number,
    destinosActivos: Number,
});
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <AdminNavbar />

        <main class="mx-auto max-w-7xl px-6 py-10">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Dashboard administrativo
                </h1>
                <p class="mt-2 text-gray-600">
                    Panel principal para administrar la información turística de GeoTurismoSV.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-4">
                <section class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm font-semibold text-[#0b6fb3]">Usuarios</p>
                    <h2 class="mt-2 text-4xl font-bold text-gray-900">{{ totalUsuarios }}</h2>
                </section>

                <section class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm font-semibold text-[#168a1a]">Categorías</p>
                    <h2 class="mt-2 text-4xl font-bold text-gray-900">{{ totalCategorias }}</h2>
                </section>

                <section class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm font-semibold text-[#f4a000]">Destinos</p>
                    <h2 class="mt-2 text-4xl font-bold text-gray-900">{{ totalDestinos }}</h2>
                </section>

                <section class="rounded-xl bg-white p-6 shadow">
                    <p class="text-sm font-semibold text-emerald-700">Destinos activos</p>
                    <h2 class="mt-2 text-4xl font-bold text-gray-900">{{ destinosActivos }}</h2>
                </section>
            </div>

            <section class="mt-10 rounded-xl bg-white p-8 shadow">
                <h2 class="text-2xl font-bold text-gray-900">
                    Gestión del sistema
                </h2>

                <p class="mt-3 text-gray-600">
                    Desde este panel el administrador puede gestionar categorías,
                    destinos turísticos y usuarios registrados en la plataforma.
                </p>

                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    <a
                        href="/admin/categorias"
                        class="rounded-xl border border-blue-100 bg-blue-50 p-5 text-[#0b6fb3] transition hover:bg-blue-100"
                    >
                        Gestionar categorías
                    </a>

                    <a
                        href="/admin/destinos"
                        class="rounded-xl border border-green-100 bg-green-50 p-5 text-[#168a1a] transition hover:bg-green-100"
                    >
                        Gestionar destinos
                    </a>

                    <a
                        href="/admin/usuarios"
                        class="rounded-xl border border-orange-100 bg-orange-50 p-5 text-[#f4a000] transition hover:bg-orange-100"
                    >
                        Ver usuarios
                    </a>
                </div>
            </section>
        </main>
    </div>
</template>