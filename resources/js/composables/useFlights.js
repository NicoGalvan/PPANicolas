import { storeToRefs } from "pinia";
import { useFlightStore } from "../stores/flightStore";
import { computed } from "vue";

export const useFlights = () => {
    const flightStore = useFlightStore();
    const { airports, origin, destiny, fecha, journeys } =
        storeToRefs(flightStore);

    const originCode = computed(() => {
        const airport = airports.value.find((a) => a.id === origin.value);
        return airport ? airport.code : null;
    });

    const destinyCode = computed(() => {
        const airport = airports.value.find((a) => a.id === destiny.value);
        return airport ? airport.code : null;
    });

    const getAirports = async () => {
        if (airports.value.length > 0) return;
        flightStore.loadAirports();
    };

    const getJourneys = async () => {
        flightStore.loadJourneys();
    };

    const formatTime = (datetime) => {
        const date = new Date(datetime);
        return date.toLocaleTimeString([], {
            hour: "2-digit",
            minute: "2-digit",
        });
    };

    const codeAirport = (id) => {
        const airport = airports.value.find((a) => a.id === origin.value);
        return airport ? airport.code : null;
    };

    const resetJourneys = () => {
      if (journeys.value.length > 0) {
        journeys.value = [];
      }
    }

    return {
        //data
        airports,
        origin,
        destiny,
        fecha,
        journeys,
        //methods
        getAirports,
        getJourneys,
        formatTime,

        //computed
        originCode,
        destinyCode,
        codeAirport,
        resetJourneys,
    };
};
