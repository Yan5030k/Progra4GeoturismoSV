<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import PublicNavbar from '@/Components/PublicNavbar.vue';

const props = defineProps({
    destino: Object,
    esFavorito: Boolean,
    usuarioLogueado: Boolean,
});

const clima = ref(null);
const cargandoClima = ref(false);
const errorClima = ref(false);

const imagenDestino = computed(() => {
    if (!props.destino?.imagen) {
        return '/img/logo-geoturismosv.png';
    }

    if (props.destino.imagen.startsWith('http')) {
        return props.destino.imagen;
    }

    if (props.destino.imagen.startsWith('/')) {
        return props.destino.imagen;
    }

    if (props.destino.imagen.startsWith('img/')) {
        return `/${props.destino.imagen}`;
    }

    return `/storage/${props.destino.imagen}`;
});

const costoFormateado = computed(() => {
    const costo = props.destino?.costo_estimado;

    if (costo === null || costo === undefined || costo === '') {
        return 'No especificado';
    }

    return `$${Number(costo).toFixed(2)}`;
});

const tieneCoordenadas = computed(() => {
    return props.destino?.latitud && props.destino?.longitud;
});

const urlGoogleMaps = computed(() => {
    if (tieneCoordenadas.value) {
        return `https://www.google.com/maps/dir/?api=1&destination=${props.destino.latitud},${props.destino.longitud}`;
    }

    const referencia = props.destino?.direccion || props.destino?.ubicacion || props.destino?.nombre;

    if (!referencia) {
        return null;
    }

    return `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(referencia + ', El Salvador')}`;
});

const horarioTexto = computed(() => {
    if (props.destino?.dias_atencion && props.destino?.hora_apertura && props.destino?.hora_cierre) {
        return `${props.destino.dias_atencion}, ${props.destino.hora_apertura} - ${props.destino.hora_cierre}`;
    }

    if (props.destino?.dias_atencion) {
        return props.destino.dias_atencion;
    }

    if (props.destino?.horario) {
        return props.destino.horario;
    }

    return 'Horario no especificado';
});

const obtenerDescripcionClima = (codigo) => {
    if (codigo === 0) return 'Despejado';
    if (codigo >= 1 && codigo <= 3) return 'Parcialmente nublado';
    if (codigo >= 45 && codigo <= 48) return 'Niebla';
    if (codigo >= 51 && codigo <= 67) return 'Lluvia';
    if (codigo >= 71 && codigo <= 77) return 'Nieve';
    if (codigo >= 80 && codigo <= 82) return 'Chubascos';
    if (codigo >= 95) return 'Tormenta';

    return 'Clima variable';
};

const obtenerIconoClima = (codigo) => {
    if (codigo === 0) return '☀️';
    if (codigo >= 1 && codigo <= 3) return '⛅';
    if (codigo >= 45 && codigo <= 48) return '🌫️';
    if (codigo >= 51 && codigo <= 67) return '🌧️';
    if (codigo >= 71 && codigo <= 77) return '❄️';
    if (codigo >= 80 && codigo <= 82) return '🌦️';
    if (codigo >= 95) return '⛈️';

    return '🌥️';
};

const cargarClima = async () => {
    cargandoClima.value = true;
    errorClima.value = false;

    try {
        let latitud = props.destino?.latitud;
        let longitud = props.destino?.longitud;

        if (!latitud || !longitud) {
            const busqueda = encodeURIComponent(`${props.destino.nombre}, ${props.destino.ubicacion ?? ''}, El Salvador`);
            const geoUrl = `https://geocoding-api.open-meteo.com/v1/search?name=${busqueda}&count=1&language=es&format=json`;

            const geoRespuesta = await fetch(geoUrl);

            if (!geoRespuesta.ok) {
                throw new Error('No se pudo obtener la ubicación para el clima.');
            }

            const geoDatos = await geoRespuesta.json();

            if (!geoDatos.results || geoDatos.results.length === 0) {
                throw new Error('No se encontraron coordenadas para el clima.');
            }

            latitud = geoDatos.results[0].latitude;
            longitud = geoDatos.results[0].longitude;
        }

        const climaUrl = `https://api.open-meteo.com/v1/forecast?latitude=${latitud}&longitude=${longitud}&current=temperature_2m,relative_humidity_2m,weather_code,wind_speed_10m`;

        const climaRespuesta = await fetch(climaUrl);

        if (!climaRespuesta.ok) {
            throw new Error('No se pudo obtener el clima.');
        }

        const climaDatos = await climaRespuesta.json();

        if (!climaDatos.current) {
            throw new Error('La API no devolvió datos actuales.');
        }

        clima.value = {
            temperatura: climaDatos.current.temperature_2m,
            humedad: climaDatos.current.relative_humidity_2m,
            viento: climaDatos.current.wind_speed_10m,
            codigo: climaDatos.current.weather_code,
        };
    } catch (error) {
        console.error('Error al obtener el clima:', error);
        errorClima.value = true;
        clima.value = null;
    } finally {
        cargandoClima.value = false;
    }
};

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

onMounted(() => {
    cargarClima();
});
</script>

<template>
    <Head :title="destino.nombre" />

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50">
        <PublicNavbar />

        <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="mb-6">
                <Link
                    href="/destinos"
                    class="inline-flex items-center rounded-full bg-white px-5 py-2 text-sm font-semibold text-[#0b6fb3] shadow-sm ring-1 ring-slate-200 transition hover:bg-blue-50 hover:text-[#168a1a]"
                >
                    ← Volver a destinos
                </Link>
            </div>

            <article class="overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-slate-100">
                <section class="grid gap-0 lg:grid-cols-2">
                    <div class="relative min-h-[380px]">
                        <img
                            :src="imagenDestino"
                            :alt="destino.nombre"
                            class="absolute inset-0 h-full w-full object-cover"
                        >

                        <div class="absolute left-5 top-5 rounded-full bg-[#168a1a] px-4 py-2 text-sm font-bold text-white shadow-lg">
                            {{ destino.categoria?.nombre ?? 'Sin categoría' }}
                        </div>

                        <div class="absolute bottom-5 right-5 max-w-xs rounded-2xl border border-white/30 bg-black/45 p-5 text-white shadow-2xl backdrop-blur-md">
                            <div v-if="cargandoClima" class="flex items-center gap-3">
                                <div class="h-5 w-5 animate-spin rounded-full border-2 border-white border-t-transparent"></div>
                                <p class="text-sm font-semibold">Consultando clima...</p>
                            </div>

                            <div v-else-if="clima && !errorClima" class="flex items-center gap-4">
                                <div class="text-5xl">
                                    {{ obtenerIconoClima(clima.codigo) }}
                                </div>

                                <div>
                                    <p class="text-4xl font-black">
                                        {{ clima.temperatura }}°C
                                    </p>

                                    <p class="text-sm font-semibold">
                                        {{ obtenerDescripcionClima(clima.codigo) }}
                                    </p>

                                    <p class="mt-1 text-xs text-white/85">
                                        Humedad {{ clima.humedad }}% · Viento {{ clima.viento }} km/h
                                    </p>
                                </div>
                            </div>

                            <div v-else>
                                <p class="text-sm font-semibold">
                                    Clima no disponible
                                </p>

                                <p class="mt-1 text-xs text-white/80">
                                    La página sigue funcionando aunque no haya conexión o la API no responda.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8 lg:p-10">
                        <p class="text-sm font-bold uppercase tracking-wide text-[#168a1a]">
                            {{ destino.departamento ?? destino.ubicacion ?? 'El Salvador' }}
                            <span v-if="destino.municipio"> · {{ destino.municipio }}</span>
                        </p>

                        <h1 class="mt-2 text-4xl font-black tracking-tight text-gray-900 sm:text-5xl">
                            {{ destino.nombre }}
                        </h1>

                        <p class="mt-5 text-lg leading-8 text-gray-600">
                            {{ destino.descripcion }}
                        </p>

                        <div class="mt-8 grid gap-4 sm:grid-cols-3">
                            <div class="rounded-2xl bg-blue-50 p-5 ring-1 ring-blue-100">
                                <p class="text-sm font-bold text-[#0b6fb3]">Costo estimado</p>
                                <p class="mt-2 text-2xl font-black text-gray-900">
                                    {{ costoFormateado }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-green-50 p-5 ring-1 ring-green-100">
                                <p class="text-sm font-bold text-[#168a1a]">Horario</p>
                                <p class="mt-2 text-sm font-semibold leading-6 text-gray-800">
                                    {{ horarioTexto }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-orange-50 p-5 ring-1 ring-orange-100">
                                <p class="text-sm font-bold text-[#f4a000]">Estado</p>
                                <p class="mt-2 text-lg font-black text-gray-900">
                                    {{ destino.estado ? 'Disponible' : 'No disponible' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <a
                                v-if="urlGoogleMaps"
                                :href="urlGoogleMaps"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center justify-center rounded-full bg-[#4285F4] px-6 py-3 font-bold text-white shadow-md transition hover:scale-105 hover:bg-[#3367D6]"
                            >
                                Cómo llegar en Google Maps
                            </a>

                            <button
                                v-if="usuarioLogueado && !esFavorito"
                                @click="guardarFavorito"
                                class="inline-flex items-center justify-center rounded-full bg-[#168a1a] px-6 py-3 font-bold text-white shadow-md transition hover:bg-green-700"
                            >
                                Guardar en favoritos
                            </button>

                            <button
                                v-if="usuarioLogueado && esFavorito"
                                @click="eliminarFavorito"
                                class="inline-flex items-center justify-center rounded-full bg-red-600 px-6 py-3 font-bold text-white shadow-md transition hover:bg-red-700"
                            >
                                Eliminar de favoritos
                            </button>

                            <Link
                                v-if="!usuarioLogueado"
                                href="/login"
                                class="inline-flex items-center justify-center rounded-full bg-gray-900 px-6 py-3 font-bold text-white shadow-md transition hover:bg-black"
                            >
                                Iniciar sesión para guardar
                            </Link>
                        </div>
                    </div>
                </section>

                <section class="grid gap-6 border-t border-slate-100 p-6 sm:p-8 lg:grid-cols-3 lg:p-10">
                    <div class="rounded-3xl bg-slate-50 p-6 ring-1 ring-slate-100 lg:col-span-2">
                        <h2 class="text-2xl font-black text-gray-900">
                            Ubicación y referencia
                        </h2>

                        <div class="mt-5 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl bg-white p-5 shadow-sm">
                                <p class="text-sm font-bold text-[#0b6fb3]">Departamento</p>
                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ destino.departamento ?? 'No especificado' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-white p-5 shadow-sm">
                                <p class="text-sm font-bold text-[#168a1a]">Municipio o distrito</p>
                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ destino.municipio ?? 'No especificado' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 rounded-2xl bg-white p-5 shadow-sm">
                            <p class="text-sm font-bold text-gray-900">Dirección o referencia</p>
                            <p class="mt-2 leading-7 text-gray-700">
                                {{ destino.direccion ?? destino.ubicacion ?? 'No especificada' }}
                            </p>
                        </div>

                        <div class="mt-6 rounded-2xl bg-emerald-50 p-5 ring-1 ring-emerald-100">
                            <h3 class="font-black text-[#168a1a]">
                                Valor turístico
                            </h3>

                            <p class="mt-2 leading-7 text-gray-700">
                                GeoTurismoSV permite conocer este destino antes de visitarlo,
                                revisando ubicación, costos, contacto, clima y recomendaciones.
                                Así el visitante puede planificar mejor su experiencia turística.
                            </p>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-slate-50 p-6 ring-1 ring-slate-100">
                        <h2 class="text-2xl font-black text-gray-900">
                            Contacto
                        </h2>

                        <div class="mt-5 space-y-4">
                            <div class="rounded-2xl bg-white p-5 shadow-sm">
                                <p class="text-sm font-bold text-[#0b6fb3]">Encargado o contacto</p>
                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ destino.contacto ?? 'No especificado' }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-white p-5 shadow-sm">
                                <p class="text-sm font-bold text-[#168a1a]">Teléfono</p>

                                <a
                                    v-if="destino.telefono"
                                    :href="`tel:${destino.telefono}`"
                                    class="mt-1 block font-semibold text-gray-800 hover:text-[#168a1a]"
                                >
                                    {{ destino.telefono }}
                                </a>

                                <p v-else class="mt-1 font-semibold text-gray-800">
                                    No especificado
                                </p>
                            </div>

                            <div class="rounded-2xl bg-white p-5 shadow-sm">
                                <p class="text-sm font-bold text-[#f4a000]">Sitio web</p>

                                <a
                                    v-if="destino.sitio_web"
                                    :href="destino.sitio_web"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-1 block font-semibold text-[#0b6fb3] hover:underline"
                                >
                                    Visitar sitio web
                                </a>

                                <p v-else class="mt-1 font-semibold text-gray-800">
                                    No especificado
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="border-t border-slate-100 p-6 sm:p-8 lg:p-10">
                    <h2 class="text-2xl font-black text-gray-900">
                        Recomendaciones
                    </h2>

                    <p class="mt-3 leading-8 text-gray-700">
                        {{ destino.recomendaciones ?? 'Antes de visitar este destino, revisa el horario, el clima aproximado y la ubicación en Google Maps para planificar mejor tu viaje.' }}
                    </p>
                </section>
            </article>
        </main>
    </div>
</template>