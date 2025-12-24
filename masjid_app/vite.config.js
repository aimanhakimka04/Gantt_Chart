import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import browserSync from 'browser-sync'

export default defineConfig({
    // Tambah bahagian server ini supaya CSS boleh dibaca dari Laptop/Network
    server: {
        host: '0.0.0.0', // Ini buka pintu untuk semua access (Localhost + Network + Tailscale)
        hmr: {
            host: '100.93.251.94', // PENTING: Masukkan IP Tailscale awak di sini
        },
        port: 5173,
    },

    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        {
            name: 'browser-sync',
            configureServer(server) {
                browserSync({
                    proxy: 'http://127.0.0.1:8000',
                    files: [
                        'resources/views/**/*.blade.php',
                        'public/css/**/*.css',
                        'resources/js/**/*.js'
                    ],
                    open: false,
                    notify: false,
                })
            }
        }
    ],
})