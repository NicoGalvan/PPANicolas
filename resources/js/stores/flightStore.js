import { defineStore } from "pinia";
import { getAirports, getJourneys } from "@/services/flightService";
import { ref, watch } from "vue";

export const useFlightStore = defineStore(
  "FlightStore",
  () => {
    const airports = ref([])
    const origin = ref('')
    const destiny = ref('')
    const fecha = ref('')
    const isLoading = ref(false);
    const error = ref(null);
    const journeys =ref([])

    const loadAirports = async () => {
        isLoading.value = true;
        error.value = null;
        try {
          const response = await getAirports();
          airports.value = response.data.data;
        } catch (err) {
          error.value = err.message;
          console.error("Error loading airports:", err);
        } finally {
          isLoading.value = false;
        }
      };

    const loadJourneys = async () => {
        isLoading.value = true;
        error.value = null;
        try {
          const response = await getJourneys(origin.value, destiny.value, fecha.value);
          journeys.value = response.data.flights;
        } catch (err) {
          error.value = err.message;
          console.error("Error loading airports:", err);
        } finally {
          isLoading.value = false;
        }
      };

      watch([origin, destiny, fecha], () => {
        // Si hay más de un viaje, reiniciar el arreglo de journeys
        if (journeys.value.length > 0) {
          journeys.value = [];
        }
      });

    return {
        //data
        airports,
        origin,
        destiny,
        fecha,
        journeys,
        //methods
        loadAirports,
        loadJourneys
    };
  },
);
