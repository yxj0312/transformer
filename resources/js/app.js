import './bootstrap';
import '../css/app.css'; 


import { createApp } from 'vue';
import { createPinia } from 'pinia'
import App from './views/App.vue'; //
import router from "./router";  这里假设你的根组件为 App.vue


const pinia = createPinia()
createApp(App).use(router).use(pinia).mount('#app');

