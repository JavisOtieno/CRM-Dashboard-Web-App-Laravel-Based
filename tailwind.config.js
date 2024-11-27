import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/**flowbite */
// module.exports = {
//     content: [

//     ],
//     theme: {
//       extend: {},
//     },
//     plugins: [],
//   }

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
        "./node_modules/flowbite/**/*.js"
    ],


    theme: {
        extend: {
            colors: {
              
                primary: {
                    DEFAULT: '#EC1F27', // Base color
                    light: '#F5626B',  // Light variant
                    dark: '#A6171C',   // Dark variant
                    50: '#FDE8E8',   // Very light variant
                    100: '#FBD4D4',  // Light variant
                    200: '#F8B1B2',  // Softer light
                    300: '#F4898A',  // Lighter red
                    400: '#F05A5B',  // Bright red
                    500: '#EC1F27',  // Base color
                    600: '#C71A20',  // Slightly darker
                    700: '#A3171A',  // Darker
                    800: '#7F1214',  // Very dark
                    900: '#5C0D0E',  // Deep dark
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('flowbite/plugin')({
            datatables: true,
        }),
        forms
    ],
};
