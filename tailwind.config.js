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
                serif: ['Libre Baskerville', 'serif'], // Para fontes serifadas
                sans: ['Open Sans', 'sans-serif'],     // Para fontes sans-serif
            },
            colors: {
                'primary-color': {
                    DEFAULT: '#fb923c', // Cor principal
                    50: '#fff3ec',
                    100: '#fee8d6',
                    150: '#fdd5c0',
                    200: '#fdc1a8',
                    250: '#fbaa8f',
                    300: '#fb9a7a',
                    350: '#fa886d',
                    400: '#fb835b',
                    450: '#fa784a',
                    500: '#fb923c',
                    550: '#f98434',
                    600: '#f9802a',
                    650: '#e67026',
                    700: '#e46e22',
                    750: '#d2601f',
                    800: '#c6571c',
                    850: '#b14a19',
                    900: '#a03f15',
                },
                'secondary-color': {
                    DEFAULT: '#151b26', // Cor cinza escuro
                    50: '#ced1d7',
                    100: '#9ca1aa',
                    150: '#8e909f',
                    200: '#828894',
                    250: '#747785',
                    300: '#686f7e',
                    350: '#5d636e',
                    400: '#4c5766',
                    450: '#404b58',
                    500: '#151b26',
                    550: '#13161f',
                    600: '#121720',
                    650: '#0f131c',
                    700: '#0f131a',
                    750: '#0d1016',
                    800: '#0c0f14',
                    850: '#0a0c11',
                    900: '#090b0e',
                },
                'accent-color': {
                    DEFAULT: '#c2410c', // Laranja escuro (baseado na imagem)
                    50: '#f3e0d6',
                    100: '#e0b59f',
                    150: '#cc8a68',
                    200: '#b35f31',
                    250: '#993f1d',
                    300: '#8b2b13',
                    350: '#7a230f',
                    400: '#6a190c',
                    450: '#5b140a',
                    500: '#c2410c', // DEFAULT
                    550: '#9a3809',
                    600: '#7f2d07',
                    650: '#682304',
                    700: '#561b03',
                    750: '#461401',
                    800: '#380f00',
                    850: '#2c0a00',
                    900: '#200500',
                },
            },
        },
    },

    plugins: [forms, typography],
};
