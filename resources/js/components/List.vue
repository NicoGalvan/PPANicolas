<template>
    <div class="list-container">
        <!-- Botón para ordenar por duración -->
        <button
        v-if="journeys.length > 0"
            @click="toggleSortOrder" 
            class="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
        >
            Ordenar por duración: {{ sortOrder === 'asc' ? 'Ascendente' : 'Descendente' }}
        </button>

        <!-- Iterar sobre los viajes ordenados -->
        <div v-for="(item, index) in sortedJourneys" :key="index" class="card drop-shadow-2xl">
            <div class="flex items-center justify-between gap-6 px-4 py-2">
                <div class="text-center text-3xl font-semibold">
                    <span>{{ originCode }}</span>
                    <div class="text-sm">{{ formatTime(item.flight_schedule.departure_time) }}</div>
                </div>

                <div class="flex items-center gap-2 relative">
                    <div class="w-24 border-t border-dashed border-gray-400"></div>

                    <span
                        v-if="item.stops.length == 0"
                        class="text-sm font-medium text-gray-600"
                    >Directo</span>
                    
                    <span
                        v-else
                        class="text-sm font-medium text-gray-600 relative cursor-pointer"
                        @mouseover="showTooltip(index)"
                        @mouseleave="hideTooltip"
                    >
                        {{ item.stops.length }} escalas
                    </span>

                    <div class="w-24 border-t border-dashed border-gray-400"></div>
                </div>

                <div class="text-center text-3xl font-semibold">
                    <span>{{ destinyCode }}</span>
                    <div class="text-sm">{{ formatTime(item.flight_schedule.arrival_time) }}</div>
                </div>

                <div class="text-center text-lg font-medium text-gray-600">
                    Duración: {{ calculateDuration(item.flight_schedule.departure_time, item.flight_schedule.arrival_time) }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useFlights } from '../composables/useFlights';
import dayjs from 'dayjs';

const { journeys, formatTime, originCode, destinyCode, codeAirport } = useFlights();
const isTooltipVisible = ref(false);
const tooltipIndex = ref(null);

// Estado para controlar el orden
const sortOrder = ref('asc'); // 'asc' o 'desc'

// Calcular la duración entre departure_time y arrival_time
function calculateDuration(departureTime, arrivalTime) {
    const departure = dayjs(departureTime);
    const arrival = dayjs(arrivalTime);
    const duration = arrival.diff(departure, 'minute'); // diferencia en minutos

    const hours = Math.floor(duration / 60);
    const minutes = duration % 60;
    return `${hours}h ${minutes}m`;
}

// Ordenar los viajes por duración dependiendo de `sortOrder`
const sortedJourneys = computed(() => {
    return journeys.value.slice().sort((a, b) => {
        const durationA = dayjs(a.flight_schedule.arrival_time).diff(dayjs(a.flight_schedule.departure_time), 'minute');
        const durationB = dayjs(b.flight_schedule.arrival_time).diff(dayjs(b.flight_schedule.departure_time), 'minute');
        
        return sortOrder.value === 'asc' ? durationA - durationB : durationB - durationA;
    });
});

// Cambiar el orden entre ascendente y descendente
function toggleSortOrder() {
    sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
}

function showTooltip(index) {
    isTooltipVisible.value = true;
    tooltipIndex.value = index;
}

function hideTooltip() {
    isTooltipVisible.value = false;
    tooltipIndex.value = null;
}
</script>

<style scoped>
.list-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    padding: 20px;
}

.card {
    width: 75%;
    padding: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
    border-radius: 8px;
    text-align: center;
    transition: transform 0.2s ease-in-out;
}

.border-dashed {
    border-style: dashed;
}
</style>
