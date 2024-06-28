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

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'custom-white': '#FFFFFF',
                'custom-gray': '#F3F4F6',
                'custom-dark': '#1F2937',
                'custom-dark-gray': '#374151',
            },
            textColor: {
                'custom-white': '#FFFFFF',
                'custom-dark': '#1F2937',
                'custom-dark-gray': '#374151',
            },
            backgroundColor: {
                'custom-white': '#FFFFFF',
                'custom-dark': '#1F2937',
            },
        },
    },

    plugins: [forms, typography],
};
