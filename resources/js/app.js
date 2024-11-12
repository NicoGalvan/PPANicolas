import './bootstrap';

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import Home from './components/Home.vue'
import Header from './components/Header.vue'
import SearchInput from './components/SearchInput.vue'

const pinia = createPinia()
const app = createApp({})

app.component('Home', Home)
app.component('Header', Header)
app.component('SearchInput', SearchInput)

app.use(pinia)
app.mount('#app')
