/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'rubik': ['Rubik', 'sans-serif'],
                'climatecrisis': ['Climate Crisis', 'cursive'],
            },
            colors: {
                'blackpanel': '#4f5962',
            },
            width: {
                '63': '15.7rem',
            },
        },
    },
    plugins: [
        require('@fortawesome/fontawesome-free'),
    ],
}

