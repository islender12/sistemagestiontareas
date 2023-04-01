import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/style.css",
                "resources/js/sweetalert2.js",
                "resources/js/app.js",
                "resources/js/createtareas.js",
                "resources/js/listatareas.js",
            ],
            refresh: true,
        }),
    ],
});
