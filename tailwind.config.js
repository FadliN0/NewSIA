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
            
            // ### SISTEM WARNA BARU YANG TERSTRUKTUR ###
            colors: {
                // Warna Netral (berlaku untuk semua)
                'charcoal': '#3D3D3D', // Untuk teks utama
                'light-gray': '#F9FAFB', // Untuk background
                'white': '#FFFFFF',

                // Tema untuk Admin
                'admin': {
                    'primary': '#2c3e50', // Biru Tua / Navy
                    'accent': '#3498db',  // Biru Langit
                    'bg': '#ecf0f1',      // Abu-abu terang
                },

                // Tema untuk Guru (menggunakan warna Anda)
                'teacher': {
                    'primary': '#0B666A', // Teal
                    'accent': '#97BE5A',  // Lime
                    'bg': '#EDF5F5',      // Pale Green
                },
                
                // Tema untuk Siswa
                'student': {
                    'primary': '#4f46e5', // Indigo
                    'accent': '#ec4899',  // Pink/Magenta
                    'bg': '#f5f3ff',      // Latar ungu pucat
                },
                
                // Warna Status
                'success': '#2ecc71',
                'warning': '#f39c12',
                'error': '#e74c3c',
            },
        },
    },

    plugins: [
        require('tailwind-scrollbar-hide'),
        forms
    ],
};