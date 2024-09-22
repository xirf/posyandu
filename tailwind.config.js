import defaultTheme from 'tailwindcss/defaultTheme';
import typography from '@tailwindcss/typography';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: [ 'Figtree', ...defaultTheme.fontFamily.sans ],
            },
        },
    },

    plugins: [ forms, daisyui, typography ],
    daisyui: {
        styled: true,
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")[ "light" ],
                    primary: "#06b6d4",
                },
            }
        ],
        rtl: false,
    },
};
