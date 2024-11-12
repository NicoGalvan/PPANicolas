<template>
    <div class="drop-shadow-2xl flex justify-center ">
        <div class="bg-white p-6 rounded-lg w-3/4">
            <form class="space-y-4 lg:space-y-0 lg:flex lg:space-x-4 lg:items-end">
                <!-- Origen -->
                <div class="flex-1">
                    <SearchInput 
                        id="origen" 
                        label="Origen" 
                        placeholder="Buscar origen" 
                        :options="airports" 
                        v-model="origin"
                        @input="resetJourneys"
                        :error="{ '!border-red-500': errors.origin }"
                    />
                </div>

                <!-- Destino -->
                <div class="flex-1">
                    <SearchInput 
                        id="destino" 
                        label="Destino" 
                        placeholder="Buscar destino" 
                        :options="airports" 
                        v-model="destiny"
                        @input="resetJourneys"
                        :error="{ '!border-red-500': errors.destiny }"
                    />
                </div>

                <!-- Fecha -->
                <div class="flex-1">
                    <label for="fecha" class="block text-lg font-medium">Fecha</label>
                    <input 
                        id="fecha" 
                        type="date" 
                        v-model="fecha"
                        class="w-full p-2 mt-1 border border-gray-300 rounded-md"
                        :class="{ 'border-red-500': errors.fecha }"
                    />
                </div>

                <!-- Botón Buscar -->
                <div class="flex-1 lg:w-auto">
                    <button 
                        @click="validateAndSearch()" 
                        type="button" 
                        class="w-full py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useFlights } from '../composables/useFlights';

const { airports, origin, destiny, fecha, getJourneys, resetJourneys } = useFlights();

// Estado de errores
const errors = ref({
    origin: false,
    destiny: false,
    fecha: false
});

// Función de validación
function validateAndSearch() {
    // Validar campos
    errors.value.origin = !origin.value;
    errors.value.destiny = !destiny.value;
    errors.value.fecha = !fecha.value;

    // Si no hay errores, ejecuta la búsqueda
    if (!errors.value.origin && !errors.value.destiny && !errors.value.fecha) {
        getJourneys();
    }
}
</script>

<style scoped>
/* Agregar estilos para los bordes rojos en los inputs */
.border-red-500 {
    border-color: #f87171 !important; /* Usando un tono rojo */
}
</style>
