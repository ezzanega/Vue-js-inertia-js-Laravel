const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#438A7A',
                secondary: '#EDF3F1',
                tertiary: '#EEEEEE',
                btnbr: '#BFBFBF',
                error: '#CC0101',
                success: '#3DA041',
                transparent: 'transparent',
                current: 'currentColor',
            },
            boxShadow : {
                primary : '0px 9.9px 21.6px rgba(136, 202, 41, 0.41)'
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
