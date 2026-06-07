<script setup>
import { ref, watch, onMounted, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import PublicNavbar from '@/Components/PublicNavbar.vue';
import { useDbTranslation } from '@/Composables/useDbTranslation';

const { tDb } = useDbTranslation();

const props = defineProps({
    destinos: Array,
    categorias: Array,
    departamentos: Array,
    filtros: Object,
});

const form = ref({
    search: props.filtros?.search || '',
    categoria_id: props.filtros?.categoria_id || '',
    departamento: props.filtros?.departamento || '',
    municipio: props.filtros?.municipio || '',
    costo_min: props.filtros?.costo_min || '',
    costo_max: props.filtros?.costo_max || '',
});



let timeout = null;


watch(form, (value) => {
    if (timeout) clearTimeout(timeout);
    
    timeout = setTimeout(() => {
        router.get('/destinos', value, {
            preserveState: true,
            preserveScroll: true,
            replace: true
        });
    }, 300); // 300ms debounce
}, { deep: true });


const limpiarFiltros = () => {
    form.value.search = '';
    form.value.categoria_id = '';
    form.value.departamento = '';
    form.value.municipio = '';
    form.value.costo_min = '';
    form.value.costo_max = '';
};

// Currency Conversion Logic
const currencies = [
    // Norte y Centroamérica
    { code: 'USD', name: 'Dólar (USD)', symbol: '$' },
    { code: 'MXN', name: 'Peso Mexicano (MXN)', symbol: '$' },
    { code: 'CAD', name: 'Dólar Canadiense (CAD)', symbol: '$' },
    { code: 'GTQ', name: 'Quetzal Guatemalteco (GTQ)', symbol: 'Q' },
    { code: 'HNL', name: 'Lempira Hondureño (HNL)', symbol: 'L' },
    { code: 'NIO', name: 'Córdoba Nicaragüense (NIO)', symbol: 'C$' },
    { code: 'CRC', name: 'Colón Costarricense (CRC)', symbol: '₡' },
    // Sudamérica
    { code: 'COP', name: 'Peso Colombiano (COP)', symbol: '$' },
    { code: 'ARS', name: 'Peso Argentino (ARS)', symbol: '$' },
    { code: 'BRL', name: 'Real Brasileño (BRL)', symbol: 'R$' },
    { code: 'CLP', name: 'Peso Chileno (CLP)', symbol: '$' },
    { code: 'PEN', name: 'Sol Peruano (PEN)', symbol: 'S/' },
    { code: 'UYU', name: 'Peso Uruguayo (UYU)', symbol: '$' },
    // Europa
    { code: 'EUR', name: 'Euro (EUR)', symbol: '€' },
    { code: 'GBP', name: 'Libra Esterlina (GBP)', symbol: '£' },
    { code: 'CHF', name: 'Franco Suizo (CHF)', symbol: 'Fr' },
    { code: 'SEK', name: 'Corona Sueca (SEK)', symbol: 'kr' }
];

const selectedCurrency = ref('USD');
const allRates = ref({});

onMounted(async () => {
    try {
        const response = await fetch('https://open.er-api.com/v6/latest/USD');
        const data = await response.json();
        if (data && data.rates) {
            allRates.value = data.rates;
        }
    } catch (error) {
        console.error('Error fetching exchange rates:', error);
    }
});

const currentExchangeRate = computed(() => {
    if (selectedCurrency.value === 'USD') return 1;
    return allRates.value[selectedCurrency.value] || 1;
});

const getConvertedPrice = (price) => {
    if (!price || selectedCurrency.value === 'USD' || currentExchangeRate.value === 1) return null;
    const converted = (parseFloat(price) * currentExchangeRate.value).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    const currencyObj = currencies.find(c => c.code === selectedCurrency.value);
    return `≈ ${currencyObj ? currencyObj.symbol : ''}${converted} ${selectedCurrency.value}`;
};



</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <PublicNavbar />

        <main class="mx-auto max-w-7xl px-6 py-10">
            <h1 class="text-3xl font-bold text-gray-900">{{ $t('destinations.title') }}</h1>
        
            <p class="mt-2 text-gray-600">
                {{ $t('destinations.desc1') }}
            </p>
            
            <p class="mt-2 text-gray-600">
                {{ $t('destinations.desc2') }}
            </p>

            <!-- Panel de Filtros -->
            
<div class="mt-6 rounded-xl bg-white p-5 shadow">
    <!-- Filtros de Ubicación y Categoría -->
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">{{ $t('destinations.search') }}</label>
            <input 
                v-model="form.search" 
                type="text" 
                :placeholder="$t('destinations.search_ph')" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#168a1a] focus:ring focus:ring-[#168a1a] focus:ring-opacity-50"
            >
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700">{{ $t('destinations.category') }}</label>
            <select 
                v-model="form.categoria_id" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#168a1a] focus:ring focus:ring-[#168a1a] focus:ring-opacity-50"
            >
                <option value="">{{ $t('destinations.all_categories') }}</option>
                <option v-for="cat in categorias" :key="cat.id" :value="cat.id">
                    {{ tDb(cat, 'nombre') }}
                </option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ $t('destinations.department') }}</label>
            <select
                v-model="form.departamento"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#168a1a] focus:ring focus:ring-[#168a1a] focus:ring-opacity-50"
            >
                <option value="">{{ $t('destinations.all_departments') }}</option>
                <option
                    v-for="departamento in departamentos"
                    :key="departamento"
                    :value="departamento"
                >
                    {{ departamento }}
                </option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ $t('destinations.municipality') }}</label>
            <input
                v-model="form.municipio"
                type="text"
                :placeholder="$t('destinations.municipality_ph')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#168a1a] focus:ring focus:ring-[#168a1a] focus:ring-opacity-50"
            >
        </div>
    </div>

    <!-- Sección de Precios -->
    <div class="mt-6 border-t border-gray-100 pt-5">
        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide mb-4">{{ $t('destinations.price_range') }}</h3>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4 items-start">
            <!-- Costo Mínimo -->
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">{{ $t('destinations.min_cost') }}</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input
                        v-model="form.costo_min"
                        type="number"
                        min="0"
                        step="0.01"
                        :placeholder="$t('destinations.cost_ph_5')"
                        class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-[#168a1a] focus:ring focus:ring-[#168a1a] focus:ring-opacity-50"
                    >
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <span class="text-gray-500 sm:text-sm font-medium">USD</span>
                    </div>
                </div>
                <Transition
                    enter-active-class="transition-all duration-300 ease-out"
                    enter-from-class="opacity-0 scale-95 -translate-y-2"
                    enter-to-class="opacity-100 scale-100 translate-y-0"
                    mode="out-in"
                >
                    <div :key="getConvertedPrice(form.costo_min) + selectedCurrency" v-if="getConvertedPrice(form.costo_min)" class="mt-2 flex items-center text-sm text-white font-bold bg-[#0b6fb3] px-3 py-1.5 rounded-md w-fit shadow-md border border-[#095a92] ring-2 ring-blue-200">
                        <svg class="w-4 h-4 mr-1.5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        <span class="tracking-wide">{{ getConvertedPrice(form.costo_min) }}</span>
                    </div>
                </Transition>
            </div>

            <!-- Costo Máximo -->
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">{{ $t('destinations.max_cost') }}</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input
                        v-model="form.costo_max"
                        type="number"
                        min="0"
                        step="0.01"
                        :placeholder="$t('destinations.cost_ph_25')"
                        class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-[#168a1a] focus:ring focus:ring-[#168a1a] focus:ring-opacity-50"
                    >
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <span class="text-gray-500 sm:text-sm font-medium">USD</span>
                    </div>
                </div>
                <Transition
                    enter-active-class="transition-all duration-300 ease-out"
                    enter-from-class="opacity-0 scale-95 -translate-y-2"
                    enter-to-class="opacity-100 scale-100 translate-y-0"
                    mode="out-in"
                >
                    <div :key="getConvertedPrice(form.costo_max) + selectedCurrency" v-if="getConvertedPrice(form.costo_max)" class="mt-2 flex items-center text-sm text-white font-bold bg-[#0b6fb3] px-3 py-1.5 rounded-md w-fit shadow-md border border-[#095a92] ring-2 ring-blue-200">
                        <svg class="w-4 h-4 mr-1.5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        <span class="tracking-wide">{{ getConvertedPrice(form.costo_max) }}</span>
                    </div>
                </Transition>
            </div>
            
            <!-- Selector de Moneda -->
            <div>
                <label class="block text-xs font-medium text-[#0b6fb3] mb-1">{{ $t('destinations.show_currency') || 'Convertir a (Opcional)' }}</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-4 h-4 text-[#0b6fb3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <select v-model="selectedCurrency" class="block w-full rounded-md border-blue-200 bg-blue-50/50 pl-9 pr-8 focus:border-[#0b6fb3] focus:ring focus:ring-[#0b6fb3] focus:ring-opacity-50 sm:text-sm text-gray-800 font-medium">
                        <option v-for="c in currencies" :key="c.code" :value="c.code">{{ c.code }} - {{ c.name.split(' (')[0] }}</option>
                    </select>
                </div>
            </div>

            <!-- Botón Limpiar Filtros -->
            <div class="flex h-full items-start pt-[22px]">
                <button
                    type="button"
                    @click="limpiarFiltros"
                    class="w-full rounded-md bg-slate-100 px-6 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-slate-200 hover:shadow-sm flex justify-center items-center gap-2 border border-slate-200"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v2H4V4zm2 4h12v12H6V8zm2 2v8h8v-8H8z"></path></svg>
                    {{ $t('destinations.clear_filters') }}
                </button>
            </div>
        </div>
    </div>
</div>

            <!-- Loader o Mensaje vacío -->
            <div v-if="destinos.length === 0" class="mt-12 text-center py-10 bg-white rounded-xl shadow">
                <p class="text-gray-500 text-lg">{{ $t('destinations.no_results') }}</p>
                <button
                    @click="limpiarFiltros"
                    class="mt-4 text-[#0b6fb3] hover:underline font-medium"
>
                    {{ $t('destinations.clear_filters') }}
</button>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <article
                    v-for="destino in destinos"
                    :key="destino.id"
                    class="overflow-hidden rounded-xl bg-white shadow transition hover:-translate-y-1 hover:shadow-lg"
                >
                    <img
                        :src="'/' + destino.imagen"
                        :alt="destino.nombre"
                        class="h-48 w-full object-cover"
                    >

                    <div class="p-5">
                        <p class="text-sm font-semibold text-[#168a1a]">
                            {{ tDb(destino.categoria, 'nombre') }}
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-gray-900">
                            {{ tDb(destino, 'nombre') }}
                        </h2>

                        <p class="mt-2 text-sm text-gray-600">
                            {{ tDb(destino, 'ubicacion') }}
                        </p>

                        <p class="mt-3 text-gray-700">
                            {{ tDb(destino, 'descripcion').substring(0, 120) }}...
                        </p>

                        <Link
                            :href="`/destinos/${destino.id}`"
                            class="mt-4 inline-block rounded-full bg-[#0b6fb3] px-4 py-2 font-semibold text-white shadow transition hover:bg-[#168a1a]"
                        >
                            {{ $t('home.view_details') }}
                        </Link>
                    </div>
                </article>
            </div>
        </main>
    </div>
</template>