import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],

    server: {
        host: "0.0.0.0",
        port: 5173,
        strictPort: true,

        hmr: {
            host: "192.168.1.11",
            // host: "10.81.45.128",
            // host: "192.168.1.12",
            protocol: "ws",
        },
    },
});

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ["resources/css/app.css", "resources/js/app.js"],
//             refresh: true,
//         }),
//     ],
//     server: {
//         host: true,
//     },
// });
