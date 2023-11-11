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
        }),
        {
            name: 'blade',
            handleHotUpdate: function ({file, server}) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        }
    ],
    server: {
        proxy: {
            '/': {
                target: 'http://localhost:8000',
                changeOrigin: true,
                ws: true,
            },
        },
    },
    resolve: {
        alias: {
            '@': path.resolve('resources/js')
        }
    }
});
