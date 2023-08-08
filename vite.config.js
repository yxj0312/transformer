import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const { createVuePlugin } = require('vite-plugin-vue');
const { createVueJsxPlugin } = require('vite-plugin-vue-jsx');

export default defineConfig({
    plugins: [
        createVuePlugin(), // Vite Vue 插件
        createVueJsxPlugin(), // 支持 Vue JSX
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
