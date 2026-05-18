<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AdminNavbar from '@/Components/AdminNavbar.vue';

defineProps({
    categorias: Array,
});

const form = useForm({
    categoria_id: '',
    nombre: '',
    descripcion: '',
    ubicacion: '',
    departamento: '',
    municipio: '',
    latitud: '',
    longitud: '',
    direccion: '',
    imagen: null,
    costo_estimado: 0,
    dias_atencion: 'Todos los días',
    hora_apertura: '',
    hora_cierre: '',
    recomendaciones: '',
    estado: true,
});

const guardarDestino = () => {
    console.log('Creando destino:', form.data());

    form.post('/admin/destinos', {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            console.log('Destino creado correctamente');
        },
        onError: (errors) => {
            console.log('Errores al crear destino:', errors);
        },
    });
};
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <AdminNavbar />

        <main class="mx-auto max-w-5xl px-6 py-10">
            <Link href="/admin/destinos" class="font-semibold text-[#0b6fb3] hover:text-[#168a1a]">
                ← Volver a destinos
            </Link>

            <section class="mt-6 rounded-xl bg-white p-8 shadow">
                <h1 class="text-3xl font-bold text-gray-900">
                    Nuevo destino turístico
                </h1>

                <p class="mt-2 text-gray-600">
                    Registra un nuevo lugar turístico dentro de la plataforma.
                </p>

                <form @submit.prevent="guardarDestino" class="mt-8 grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block font-semibold text-gray-700">Categoría</label>
                        <select
                            v-model="form.categoria_id"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >
                            <option value="">Seleccione una categoría</option>
                            <option
                                v-for="categoria in categorias"
                                :key="categoria.id"
                                :value="categoria.id"
                            >
                                {{ categoria.nombre }}
                            </option>
                        </select>
                        <p v-if="form.errors.categoria_id" class="mt-2 text-sm text-red-600">
                            {{ form.errors.categoria_id }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Nombre del destino</label>
                        <input
                            v-model="form.nombre"
                            type="text"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                            placeholder="Ejemplo: Playa El Tunco"
                        >
                        <p v-if="form.errors.nombre" class="mt-2 text-sm text-red-600">
                            {{ form.errors.nombre }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Ubicación</label>
                        <input
                            v-model="form.ubicacion"
                            type="text"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                            placeholder="Ejemplo: Tamanique, La Libertad"
                        >
                        <p v-if="form.errors.ubicacion" class="mt-2 text-sm text-red-600">
                            {{ form.errors.ubicacion }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Departamento</label>

                        <select
                            v-model="form.departamento"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >
                            <option value="">Seleccione un departamento</option>
                            <option value="Ahuachapán">Ahuachapán</option>
                            <option value="Santa Ana">Santa Ana</option>
                            <option value="Sonsonate">Sonsonate</option>
                            <option value="Chalatenango">Chalatenango</option>
                            <option value="La Libertad">La Libertad</option>
                            <option value="San Salvador">San Salvador</option>
                            <option value="Cuscatlán">Cuscatlán</option>
                            <option value="La Paz">La Paz</option>
                            <option value="Cabañas">Cabañas</option>
                            <option value="San Vicente">San Vicente</option>
                            <option value="Usulután">Usulután</option>
                            <option value="San Miguel">San Miguel</option>
                            <option value="Morazán">Morazán</option>
                            <option value="La Unión">La Unión</option>
                        </select>

                        <p v-if="form.errors.departamento" class="mt-2 text-sm text-red-600">
                            {{ form.errors.departamento }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Municipio o distrito</label>

                        <input
                            v-model="form.municipio"
                            type="text"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                            placeholder="Ejemplo: Tamanique"
                        >

                        <p v-if="form.errors.municipio" class="mt-2 text-sm text-red-600">
                            {{ form.errors.municipio }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Latitud</label>

                        <input
                            v-model="form.latitud"
                            type="number"
                            step="0.0000001"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                            placeholder="Ejemplo: 13.4942000"
                        >

                        <p class="mt-1 text-sm text-gray-500">
                            Opcional. Se utilizará para el mapa turístico.
                        </p>

                        <p v-if="form.errors.latitud" class="mt-2 text-sm text-red-600">
                            {{ form.errors.latitud }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Longitud</label>

                        <input
                            v-model="form.longitud"
                            type="number"
                            step="0.0000001"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                            placeholder="Ejemplo: -89.3812000"
                        >

                        <p class="mt-1 text-sm text-gray-500">
                            Opcional. Se utilizará para el mapa turístico.
                        </p>

                        <p v-if="form.errors.longitud" class="mt-2 text-sm text-red-600">
                            {{ form.errors.longitud }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Dirección o referencia</label>
                        <input
                            v-model="form.direccion"
                            type="text"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                            placeholder="Referencia del lugar"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Imagen</label>
                        <input
                            type="file"
                            accept="image/*"
                            @change="form.imagen = $event.target.files[0]"
                            class="mt-2 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >

                        <p class="mt-1 text-sm text-gray-500">
                            Selecciona una imagen en formato jpg, jpeg, png o webp. Máximo 2 MB.
                        </p>

                        <p v-if="form.errors.imagen" class="mt-2 text-sm text-red-600">
                            {{ form.errors.imagen }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Costo estimado</label>
                        <input
                            v-model="form.costo_estimado"
                            type="number"
                            step="0.01"
                            min="0"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >
                        <p v-if="form.errors.costo_estimado" class="mt-2 text-sm text-red-600">
                            {{ form.errors.costo_estimado }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Días de atención</label>

                        <select
                            v-model="form.dias_atencion"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >
                            <option value="">Seleccione una opción</option>
                            <option value="Todos los días">Todos los días</option>
                            <option value="Lunes a viernes">Lunes a viernes</option>
                            <option value="Sábado y domingo">Sábado y domingo</option>
                            <option value="Lunes a sábado">Lunes a sábado</option>
                            <option value="Solo domingo">Solo domingo</option>
                        </select>

                        <p v-if="form.errors.dias_atencion" class="mt-2 text-sm text-red-600">
                            {{ form.errors.dias_atencion }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Hora de apertura</label>

                        <input
                            v-model="form.hora_apertura"
                            type="time"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >

                        <p v-if="form.errors.hora_apertura" class="mt-2 text-sm text-red-600">
                            {{ form.errors.hora_apertura }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Hora de cierre</label>

                        <input
                            v-model="form.hora_cierre"
                            type="time"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >

                        <p v-if="form.errors.hora_cierre" class="mt-2 text-sm text-red-600">
                            {{ form.errors.hora_cierre }}
                        </p>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700">Estado</label>
                        <select
                            v-model="form.estado"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        >
                            <option :value="true">Activo</option>
                            <option :value="false">Inactivo</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-semibold text-gray-700">Descripción</label>
                        <textarea
                            v-model="form.descripcion"
                            rows="4"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        ></textarea>
                        <p v-if="form.errors.descripcion" class="mt-2 text-sm text-red-600">
                            {{ form.errors.descripcion }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-semibold text-gray-700">Recomendaciones</label>
                        <textarea
                            v-model="form.recomendaciones"
                            rows="3"
                            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0b6fb3] focus:ring-[#0b6fb3]"
                        ></textarea>
                    </div>

                    <div class="flex gap-3 md:col-span-2">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="rounded-full bg-[#168a1a] px-6 py-3 font-semibold text-white shadow hover:bg-green-700 disabled:opacity-50"
                        >
                            Guardar destino
                        </button>

                        <Link
                            href="/admin/destinos"
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