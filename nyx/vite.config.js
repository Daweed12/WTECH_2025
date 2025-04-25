import { defineConfig } from 'vite';           // ⬅️ späť!
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/products.css',   // náš nový súbor
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
