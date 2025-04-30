// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/create-klas.js',
                'resources/js/create-evaluatie.js',
                'node_modules/bootstrap/dist/css/bootstrap.min.css'
            ],
            refresh: true,
        }),
    ],
});
