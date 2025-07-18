import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/gamestyle.css',


                'resources/js/app.js',
                'resources/js/extra.js',



            
            ],
            refresh: true,
        }),
    ],
});
