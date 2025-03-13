import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/fonts.css',
                'resources/css/reset.css',
                'resources/css/app.css',

                'resources/js/alpine.js'
            ],
            refresh: true,
        }),
    ],
});
