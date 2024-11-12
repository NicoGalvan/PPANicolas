<template>
  <div class="relative z-50">
    <label :for="id" class="block text-lg font-medium">{{ label }}</label>
    <input :id="id" type="search" v-model="query" @input="filterOptions"
      class="w-full p-2 mt-1 border border-gray-300 rounded-md z-50" :placeholder="placeholder" :class="error"
      autocomplete="off" />
    <!-- Opciones filtradas -->
    <ul v-if="filteredOptions.length > 0"
      class="absolute w-full mt-2 bg-white border border-gray-300 rounded-md max-h-60 overflow-y-auto shadow-lg z-50">
      <li v-for="(option, index) in filteredOptions" :key="index" @click="selectOption(option)"
        class="px-4 py-2 cursor-pointer hover:bg-blue-100 z-50">
        {{ option.text }}
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// Definir propiedades que se recibirán del componente padre
const props = defineProps({
  id: {
    type: String,
    required: true
  },
  label: {
    type: String,
    required: true
  },
  placeholder: {
    type: String,
    required: true
  },
  options: {
  },
  error: {
  }
});

// Definir los valores reactivos
const query = ref('');
const filteredOptions = ref([]);

// Función para filtrar las opciones
const filterOptions = () => {
  emit('input')
  filteredOptions.value = props.options.filter(option =>
    option.city.toLowerCase().includes(query.value.toLowerCase())
  );
};

// Emitir el id de la opción seleccionada al componente padre
const emit = defineEmits();
const selectOption = (option) => {
  query.value = option.city;  // Actualizamos la consulta con el nombre de la ciudad
  filteredOptions.value = [];  // Cerrar las opciones después de seleccionar
  emit('update:modelValue', option.id);  // Emitir solo el id al componente padre
};
</script>

<style scoped>
/* Estilo para asegurar que las opciones se superpongan sin mover el input */
input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
}

ul {
  position: absolute;
  /* Asegura que el dropdown se superponga sin mover el input */
  top: calc(100% + 2px);
  /* Para que aparezca debajo del input */
  left: 0;
  right: 0;
  z-index: 100;
}
</style>
