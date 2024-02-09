import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        Vue({
            template:{
                compilerOptions:{

                },
                transformAssetUrls:{

                },
            }
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/app.scss'],
            refresh: true,
        }),
    ],
});
