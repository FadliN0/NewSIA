import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Custom Color Palette - ubah nama yang conflict
                'ivory': '#FCFCFC',
                'teal-custom': '#0B666A',        // Ganti dari teal.dark
                'lime-custom': '#97BE5A',        // Ganti dari lime.accent  
                'charcoal': '#3D3D3D',
                'pale-green': '#EDF5F5',
                'fresh-green': '#198754',
                'brick-red': '#d14d4d',
                'warning-orange': '#fd7e14',
            }
        },
    },

    plugins: [forms],
};