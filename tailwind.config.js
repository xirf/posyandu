import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
    ],
    darkMode: "class",
    theme: {
        extend: {
            fontFamily: {
                sans: [ 'Figtree', ...defaultTheme.fontFamily.sans ],
            },
        },
    },

    plugins: [
        forms,
        require("daisyui")
    ],
    daisyui: {
        themes: [{
            light: {
                ...require("daisyui/src/theming/themes")[ "light" ],
                primary: "#06b6d4",
                "primary-content": "#fff"
            }
        }]
    },
    whitelist: ['border-l-blue-500', 'border-l-pink-500'],
};
