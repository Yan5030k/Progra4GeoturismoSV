<script setup>
import { Link, useForm, router } from '@inertiajs/vue3';
import AdminNavbar from '@/Components/AdminNavbar.vue';

const props = defineProps({
    categoria: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    nombre: props.categoria.nombre ?? '',
    descripcion: props.categoria.descripcion ?? '',
    estado: Boolean(props.categoria.estado),
});

const actualizarCategoria = () => {
    const url = `/admin/categorias/${props.categoria.id}`;

    console.log('Editando categoría ID:', props.categoria.id);
    console.log('Enviando PUT a:', url);

    router.put(url, {
        nombre: form.nombre,
        descripcion: form.descripcion,
        estado: form.estado,
    }, {
        preserveScroll: true,
        onError: (errors) => {
            form.errors = errors;
        },
    });
};
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <AdminNavbar />

        <main class="mx-auto max-w-4xl px-6 py-10">
            <Link href="/admin/categorias" class="font-semibold text-[#0b6fb3] hover:text-[#168a1a]">
                ← Volver a categorías
            </Link>

            <section class="mt-6 rounded-xl bg-white p-8 shadow">
                <h1 class="text-3xl font-bold text-gray-900">
                    Editar categoría
                </h1>

                <p class="mt-2 text-gray-600">
                    ID actual de la categoría: {{ categoria.id }}
                </p>

                <form @submit.prevent="actualizarCategoria" class="mt-8 space-y-6">
                    <div>
                        <label class="block font-semibold text-gray-700">
                            Nombre de la categoría
                        </label>

                        <input
                            v-model="form.nombre"
                            type="text"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >

                        <p v-if="form.errors.nombre" class="mt-2 text-sm text-red-600">
                            {{ form.errors.nombre }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">
                            Descripción
                        </label>

                        <textarea
                            v-model="form.descripcion"
                            rows="4"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        ></textarea>

                        <p v-if="form.errors.descripcion" class="mt-2 text-sm text-red-600">
                            {{ form.errors.descripcion }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">
                            Estado
                        </label>

                        <select
                            v-model="form.estado"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >
                            <option :value="true">Activa</option>
                            <option :value="false">Inactiva</option>
                        </select>

                        <p v-if="form.errors.estado" class="mt-2 text-sm text-red-600">
                            {{ form.errors.estado }}
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="rounded-full bg-[#168a1a] px-6 py-3 font-semibold text-white shadow hover:bg-green-700 disabled:opacity-50"
                        >
                            Actualizar categoría
                        </button>

                        <Link
                            href="/admin/categorias"
                            class="rounded-full border border-gray-300 px-6 py-3 font-semibold text-gray-700 hover:bg-gray-100"
                        >
                            Cancelar
                        </Link>
                    </div>
                </form>
            </section>
        </main>
    </div>
</template>