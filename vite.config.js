import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import UnoCss from "unocss/vite";
import unocss from 'unocss/postcss';

export default defineConfig({
    plugins: [
        laravel({
            input: [ 'resources/css/app.css', 'resources/js/app.js' ],
            refresh: true,
        }),
        unocss({
            injectReset: true
        })
    ],
});
