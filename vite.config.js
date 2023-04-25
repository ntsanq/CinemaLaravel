import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import dotenv from 'dotenv';
// import basicSsl from '@vitejs/plugin-basic-ssl';

dotenv.config();
export default defineConfig({
    // server: {
    //     https: true,
    //     host: 'cinema.sangnguyen.me'
    // },
    plugins: [
        // basicSsl(),
        laravel({
            input: [
                'resources/js/app.jsx',
            ],
            refresh: true,
        }),
        react(),
    ],
});
