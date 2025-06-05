import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/import-groepen.js',
                'resources/js/create-evaluatie.js',
<<<<<<< HEAD:peer-assesment-tool/vite.config.js
                'node_modules/bootstrap/dist/css/bootstrap.min.css',
                'resources/js/import-groepen.js'
=======
                'resources/js/create-klas.js',
                'resources/js/kanban.js',
                'resources/css/kanban.css',
                'resources/js/edit-evaluatie.js',
                'resources/css/import-groepen.css',
>>>>>>> jonas:pat/vite.config.js
            ],
            refresh: true,
        }),
    ],
});
