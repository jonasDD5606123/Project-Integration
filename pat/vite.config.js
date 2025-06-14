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
                'resources/js/create-klas.js',
                'resources/js/kanban.js',
                'resources/css/kanban.css',
                'resources/js/edit-evaluatie.js',
                'resources/css/import-groepen.css',
                'resources/css/dashboard-docent.css',
                'resources/css/student-beheer.css',
                'resources/css/evaluatie-docent.css',
                'resources/css/groepen-beheer.css',
            ],
            refresh: true,
        }),
    ],
});
