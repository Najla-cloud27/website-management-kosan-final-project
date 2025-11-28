import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // SCSS
                "resources/scss/app.scss",
                
                // JS
                "resources/js_ubold/app.js",
                "resources/js_ubold/config.js",
            ],
            refresh: true,
        }),
    ],
});
