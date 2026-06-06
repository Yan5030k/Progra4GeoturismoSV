<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import PublicNavbar from '@/Components/PublicNavbar.vue';
import { useDbTranslation } from '@/Composables/useDbTranslation';
import { useI18n } from 'vue-i18n';

const { tDb } = useDbTranslation();
const { locale } = useI18n();

const props = defineProps({
    destino: Object,
    esFavorito: Boolean,
    usuarioLogueado: Boolean,
});

const clima = ref(null);
const cargandoClima = ref(true);

// TTS State
const estaReproduciendo = ref(false);
let synth = null;
let utterance = null;

const obtenerIconoClima = (codigo) => {
    if (codigo === 0) return '☀️ Despejado';
    if (codigo >= 1 && codigo <= 3) return '⛅ Parcialmente nublado';
    if (codigo >= 45 && codigo <= 48) return '🌫️ Niebla';
    if (codigo >= 51 && codigo <= 67) return '🌧️ Lluvia';
    if (codigo >= 71 && codigo <= 77) return '❄️ Nieve';
    if (codigo >= 80 && codigo <= 82) return '🌦️ Chubascos';
    if (codigo >= 95) return '⛈️ Tormenta';
    return '🌥️ Nublado';
};

onMounted(async () => {
    // Initialize Speech Synthesis
    if (typeof window !== 'undefined' && 'speechSynthesis' in window) {
        synth = window.speechSynthesis;
        // Trigger loading of voices
        synth.getVoices();
    }

    try {
        const query = encodeURIComponent(`${props.destino.nombre}, El Salvador`);
        const geoUrl = `https://geocoding-api.open-meteo.com/v1/search?name=${query}&count=1&language=es&format=json`;
        const geoRes = await fetch(geoUrl);
        const geoData = await geoRes.json();
        
        let lat, lon;
        
        if (props.destino.latitud && props.destino.longitud) {
            lat = props.destino.latitud;
            lon = props.destino.longitud;
        } else if (geoData.results && geoData.results.length > 0) {
            lat = geoData.results[0].latitude;
            lon = geoData.results[0].longitude;
        } else {
            lat = 13.6929;
            lon = -89.2182;
        }
        
        const weatherUrl = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`;
        const weatherRes = await fetch(weatherUrl);
        const weatherData = await weatherRes.json();
        
        if (weatherData.current_weather) {
            clima.value = weatherData.current_weather;
        }
    } catch (e) {
        console.error("Error al obtener el clima:", e);
    } finally {
        cargandoClima.value = false;
    }
});

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

const alternarReproduccion = () => {
    if (!synth) return;

    if (estaReproduciendo.value) {
        synth.cancel();
        estaReproduciendo.value = false;
        return;
    }

    let texto = tDb(props.destino, 'descripcion');
    if (!texto) return;

    const depto = props.destino.departamento;
    const muni = props.destino.municipio;
    
    if (depto || muni) {
        let locationText = '';
        if (locale.value === 'en') {
            if (depto && muni) locationText = ` It is located in the department of ${depto}, municipality of ${muni}.`;
            else if (depto) locationText = ` It is located in the department of ${depto}.`;
            else if (muni) locationText = ` It is located in the municipality of ${muni}.`;
        } else {
            if (depto && muni) locationText = ` Se encuentra ubicado en el departamento de ${depto}, municipio de ${muni}.`;
            else if (depto) locationText = ` Se encuentra ubicado en el departamento de ${depto}.`;
            else if (muni) locationText = ` Se encuentra ubicado en el municipio de ${muni}.`;
        }
        texto += locationText;
    }

    // Use vue-i18n locale instead of document.lang
    const currentLang = locale.value === 'en' ? 'en-US' : 'es-ES';
    
    utterance = new SpeechSynthesisUtterance(texto);
    utterance.lang = currentLang;
    utterance.rate = 0.95; 

    // Try to explicitly pick a voice that matches the language
    const voices = synth.getVoices();
    if (voices.length > 0) {
        const preferredVoice = voices.find(v => v.lang.startsWith(locale.value));
        if (preferredVoice) {
            utterance.voice = preferredVoice;
        }
    }

    utterance.onend = () => { estaReproduciendo.value = false; };
    utterance.onerror = () => { estaReproduciendo.value = false; };

    estaReproduciendo.value = true;
    synth.speak(utterance);
};

onUnmounted(() => {
    if (synth && estaReproduciendo.value) {
        synth.cancel();
    }
});
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <PublicNavbar />

        <main class="mx-auto max-w-5xl px-6 py-10">
            <Link href="/destinos" class="font-semibold text-[#0b6fb3] hover:text-[#168a1a]">
                {{ $t('detail.back') }}
            </Link>

            <article class="mt-6 overflow-hidden rounded-xl bg-white shadow-lg">
                <div class="relative">
                    <img
                        :src="'/' + destino.imagen"
                        :alt="destino.nombre"
                        class="h-96 w-full object-cover"
                    >

                    <!-- Widget de Clima Flotante (Glassmorphism) -->
                    <div class="absolute bottom-6 right-6 rounded-2xl bg-black/40 backdrop-blur-md border border-white/20 p-5 shadow-2xl transition-transform duration-300 hover:scale-105">
                        <div v-if="cargandoClima" class="flex items-center gap-3 text-white/90 text-sm font-medium">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ $t('detail.weather_loading') }}
                        </div>
                        <div v-else-if="clima" class="flex items-center gap-4">
                            <div class="text-5xl drop-shadow-lg">
                                {{ obtenerIconoClima(clima.weathercode).split(' ')[0] }}
                            </div>
                            <div>
                                <p class="text-4xl font-black text-white drop-shadow-md tracking-tight">{{ clima.temperature }}°C</p>
                                <p class="text-sm font-medium text-white/90 capitalize drop-shadow-sm">{{ obtenerIconoClima(clima.weathercode).split(' ').slice(1).join(' ') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <p class="font-semibold text-[#168a1a]">
                        {{ tDb(destino.categoria, 'nombre') }}
                    </p>

                    <h1 class="mt-2 text-4xl font-bold text-gray-900">
                        {{ tDb(destino, 'nombre') }}
                    </h1>

                    <p class="mt-2 text-gray-600">{{ tDb(destino, 'ubicacion') }}</p>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div class="rounded-xl bg-blue-50 p-4">
                            <strong class="text-[#0b6fb3]">{{ $t('detail.cost') }}</strong>
                            <p class="mt-1 text-gray-700">${{ destino.costo_estimado }}</p>
                        </div>

                        <div class="rounded-xl bg-green-50 p-4">
                            <strong class="text-[#168a1a]">{{ $t('detail.hours') }}</strong>

                            <p class="mt-1 text-gray-700">
                                {{ tDb(destino, 'dias_atencion') ?? tDb(destino, 'horario') ?? $t('detail.hours_unspecified') }}
                            </p>

                            <p class="text-gray-700">
                                <span v-if="destino.hora_apertura && destino.hora_cierre">
                                    {{ destino.hora_apertura }} - {{ destino.hora_cierre }}
                                </span>

                                <span v-else>
                                    {{ $t('detail.time_unspecified') }}
                                </span>
                            </p>
                        </div>

                        <div class="rounded-xl bg-orange-50 p-4">
                            <strong class="text-[#f4a000]">{{ $t('detail.status') }}</strong>
                            <p class="mt-1 text-gray-700">
                                {{ destino.estado ? $t('detail.available') : $t('detail.unavailable') }}
                            </p>
                        </div>
                    </div>

                    <section class="mt-8">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $t('detail.description') }}</h2>
                            
                            <button 
                                @click="alternarReproduccion"
                                class="flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition-colors shadow-sm"
                                :class="estaReproduciendo ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-[#e7f3eb] text-[#168a1a] hover:bg-[#d4ecd9]'"
                            >
                                <svg v-if="!estaReproduciendo" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
                                </svg>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                                </svg>
                                {{ estaReproduciendo ? $t('detail.stop_listening', 'Detener') : $t('detail.listen', 'Escuchar') }}
                            </button>
                        </div>
                        <p class="mt-4 leading-relaxed text-gray-700 whitespace-pre-wrap">
                            {{ tDb(destino, 'descripcion') }}
                        </p>
                    </section>

                    <section class="mt-6">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $t('detail.location') }}</h2>

                        <div class="mt-3 grid gap-4 md:grid-cols-2">
                            <div class="rounded-xl bg-blue-50 p-4">
                                <strong class="text-[#0b6fb3]">{{ $t('detail.department') }}</strong>
                                <p class="mt-1 text-gray-700">
                                    {{ destino.departamento ?? $t('detail.unspecified') }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-green-50 p-4">
                                <strong class="text-[#168a1a]">{{ $t('detail.municipality') }}</strong>
                                <p class="mt-1 text-gray-700">
                                    {{ destino.municipio ?? $t('detail.unspecified') }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 rounded-xl bg-slate-100 p-4">
                            <strong class="text-gray-900">{{ $t('detail.address') }}</strong>
                            <p class="mt-1 leading-relaxed text-gray-700">
                                {{ tDb(destino, 'direccion') ?? $t('detail.address_unspecified') }}
                            </p>
                        </div>

                        <div v-if="destino.latitud && destino.longitud" class="mt-6 flex justify-start">
                            <a
                                :href="`https://www.google.com/maps/dir/?api=1&destination=${destino.latitud},${destino.longitud}`"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 rounded-xl bg-[#4285F4] px-6 py-3 font-semibold text-white shadow-md transition-transform hover:scale-105 hover:bg-[#3367D6]"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                                {{ $t('detail.google_maps') }}
                            </a>
                        </div>
                    </section>
                    
                    <section class="mt-6">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $t('detail.contact_info') }}</h2>

                        <div class="mt-3 grid gap-4 md:grid-cols-3">
                            <div class="rounded-xl bg-blue-50 p-4">
                                <strong class="text-[#0b6fb3]">{{ $t('detail.contact') }}</strong>
                                <p class="mt-1 text-gray-700">
                                    {{ tDb(destino, 'contacto') ?? $t('detail.unspecified') }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-green-50 p-4">
                                <strong class="text-[#168a1a]">{{ $t('detail.phone') }}</strong>
                                <p class="mt-1 text-gray-700">
                                    {{ destino.telefono ?? $t('detail.unspecified') }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-orange-50 p-4">
                                <strong class="text-[#f4a000]">{{ $t('detail.website') }}</strong>

                                <a
                                    v-if="destino.sitio_web"
                                    :href="destino.sitio_web"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-1 inline-block text-[#0b6fb3] hover:underline"
                                >
                                    {{ $t('detail.visit_website') }}
                                </a>

                                <p v-else class="mt-1 text-gray-700">
                                    {{ $t('detail.unspecified') }}
                                </p>
                            </div>
                        </div>
                    </section>

                    <section class="mt-6">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $t('detail.recommendations') }}</h2>
                        <p class="mt-2 leading-relaxed text-gray-700 whitespace-pre-wrap">
                            {{ tDb(destino, 'recomendaciones') }}
                        </p>
                    </section>

                    <div v-if="usuarioLogueado" class="mt-8 rounded-xl bg-slate-100 p-5">
                        <h2 class="text-xl font-bold text-gray-900">
                            {{ $t('detail.interested') }}
                        </h2>

                        <p class="mt-1 text-gray-600">
                            {{ $t('detail.interested_desc') }}
                        </p>

                        <button
                            v-if="!esFavorito"
                            @click="guardarFavorito"
                            class="mt-4 rounded-full bg-[#168a1a] px-5 py-3 font-semibold text-white shadow transition hover:bg-green-700"
                        >
                            {{ $t('detail.save_favorite') }}
                        </button>

                        <button
                            v-else
                            @click="eliminarFavorito"
                            class="mt-4 rounded-full bg-red-600 px-5 py-3 font-semibold text-white shadow transition hover:bg-red-700"
                        >
                            {{ $t('detail.remove_favorite') }}
                        </button>
                    </div>

                    <div v-else class="mt-8 rounded-xl border border-yellow-200 bg-yellow-50 p-5 text-yellow-800">
                        <h2 class="font-bold">{{ $t('detail.login_favorite') }}</h2>
                        <p class="mt-1">
                            {{ $t('detail.login_desc') }}
                        </p>

                        <Link
                            href="/login"
                            class="mt-4 inline-block rounded-full bg-[#f4a000] px-5 py-2 font-semibold text-white shadow hover:bg-orange-500"
                        >
                            {{ $t('detail.login_btn') }}
                        </Link>
                    </div>
                </div>
            </article>
        </main>
    </div>
</template>