import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import * as path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/backend/backend.css',
            ],
            refresh: true,
        })
    ],
    resolve: {
        alias: {
            '@': path.resolve('resources/js')
        }
    }
});
