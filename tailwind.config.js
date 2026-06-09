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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50:  '#EEF3FF',
                    100: '#E0EAFF',
                    200: '#C8D7FE',
                    300: '#A7BCFC',
                    400: '#8098F9',
                    500: '#6172F3',
                    600: '#4A55E8',
                    700: '#3A3FC8',
                    800: '#3135A3',
                    900: '#2D3181',
                },
            },
            borderRadius: {
                'xl':  '12px',
                '2xl': '16px',
            },
            boxShadow: {
                'card':    '0 1px 3px rgba(0,0,0,.07), 0 1px 2px rgba(0,0,0,.04)',
                'card-hv': '0 4px 12px rgba(0,0,0,.08), 0 2px 4px rgba(0,0,0,.04)',
                'drop':    '0 4px 20px rgba(0,0,0,.12), 0 2px 8px rgba(0,0,0,.06)',
                'modal':   '0 20px 60px rgba(0,0,0,.13), 0 8px 24px rgba(0,0,0,.08)',
                'sidebar': '4px 0 24px rgba(0,0,0,.10)',
            },
        },
    },

    plugins: [forms],
};
