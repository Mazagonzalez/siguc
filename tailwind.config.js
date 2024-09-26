import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundColor: {
                'body-light' : '#dfe2eb',
                'body-dark' : '#121212'
            },
            colors: {
                'body-light' : '#dfe2eb',
                'body-dark' : '#121212'
            },
            borderColor: {
                'body-light' : '#dfe2eb',
                'body-dark' : '#121212'
            },
            fill: {
                'body-light' : '#dfe2eb',
                'body-dark' : '#121212'
            },
            stroke: {
                'body-light' : '#dfe2eb',
                'body-dark' : '#121212'
            }
        },
    },

    plugins: [require('daisyui'), forms, typography],

    daisyui: { themes: ["corporate"] },
};
