import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import { PrimeVueResolver } from "@primevue/auto-import-resolver";
import Components from 'unplugin-vue-components/vite';
import path from "path";

export default defineConfig({

    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js'
            ],
            refresh: false,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        Components({
            globs: [
                'resources/js/base/ui/**'
            ],
            extensions: ['vue'],
            resolvers: [
                PrimeVueResolver()
            ]
        })
    ],
    resolve: {
        alias: {
            0: {
                // this is required for the SCSS modules
                find: /^~(.*)$/,
                replacement: '$1',
            },
            '@dictionary': path.resolve(__dirname, './resources/js/modules/dictionary'),
        },
    },
    build: {
        target: 'esnext',
        chunkSizeWarningLimit: 1600,
    },
})
