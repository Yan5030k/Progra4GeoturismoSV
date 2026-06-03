<script setup>
import { ref, watch } from 'vue';
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
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
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

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ $t('destinations.min_cost') }}</label>
            <input
                v-model="form.costo_min"
                type="number"
                min="0"
                step="0.01"
                :placeholder="$t('destinations.cost_ph_5')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#168a1a] focus:ring focus:ring-[#168a1a] focus:ring-opacity-50"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ $t('destinations.max_cost') }}</label>
            <input
                v-model="form.costo_max"
                type="number"
                min="0"
                step="0.01"
                :placeholder="$t('destinations.cost_ph_25')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#168a1a] focus:ring focus:ring-[#168a1a] focus:ring-opacity-50"
            >
        </div>
    </div>

    <div class="mt-4 flex justify-end">
        <button
            type="button"
            @click="limpiarFiltros"
            class="rounded-full bg-slate-200 px-5 py-2 font-semibold text-gray-700 transition hover:bg-slate-300"
        >
            {{ $t('destinations.clear_filters') }}
        </button>
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