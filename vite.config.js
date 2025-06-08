import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig(({ mode }) => {
    const isStandalone = mode === 'netlify';
    
    if (isStandalone) {
        // Standalone SPA build for Netlify
        return {
            plugins: [
                vue({
                    template: {
                        transformAssetUrls: {
                            base: null,
                            includeAbsolute: false,
                        },
                    },
                }),
            ],
            resolve: {
                alias: {
                    vue: 'vue/dist/vue.esm-bundler.js',
                },
            },
            build: {
                rollupOptions: {
                    input: {
                        main: 'index.html'
                    }
                },
                outDir: 'dist',
                emptyOutDir: true
            }
        };
    }
    
    // Laravel development build
    return {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        resolve: {
            alias: {
                vue: 'vue/dist/vue.esm-bundler.js',
            },
        },
    };
});
