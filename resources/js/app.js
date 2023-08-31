import './bootstrap';
import '../css/app.css'; 

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import { createApp } from 'vue';
import { createPinia } from 'pinia'
import App from './views/App.vue'; // 这里假设你的根组件为 App.vue

const pinia = createPinia()
createApp(App).use(pinia).mount('#app');

