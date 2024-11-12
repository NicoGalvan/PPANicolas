<script setup>
import { onMounted } from 'vue'
import Search from './Search.vue'
import { useFlights } from '../composables/useFlights'
import List from './List.vue'
const { getAirports } = useFlights()

onMounted(() => {
    getAirports()
})
</script>

<template>
    <Header/>
    <Search class="mt-12"/>
    <List class="mt-12"/>
</template>