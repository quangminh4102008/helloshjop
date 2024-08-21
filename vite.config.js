import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['pagination/css/app.css', 'pagination/js/app.js'],
            refresh: true,
        }),
    ],
});
