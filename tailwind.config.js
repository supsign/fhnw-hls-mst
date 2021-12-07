const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    important: true,
    purge: {
        options: {
            safelist: [/^media-library/],
        },
        content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.ts', './resources/**/*.vue'],
    },
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                hls: {
                    DEFAULT: '#FDE70E',
                    200: '#fef387',
                    700: '#ead20a',
                },
            },
            height: {
                120: '30rem',
            },
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1280px',
                xxl: '1536px',
                '4xl': '1921px',
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio'),
        require('tailwindcss-hyphens'),
        require('autoprefixer'),
        require('tailwind-scrollbar'),
    ],
};
