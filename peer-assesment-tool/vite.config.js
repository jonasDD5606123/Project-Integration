// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/imports.js',
                'node_modules/bootstrap/dist/css/bootstrap.min.css'
            ],
            refresh: true,
        }),
    ],
});
