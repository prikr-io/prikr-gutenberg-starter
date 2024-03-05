const themeConfig = require('./theme.config');
const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    'src/php/*.php',
    'src/php/**/*.php',
    'src/js/*.js',
    'src/js/**/*.js',
    'footer.php',
    'header.php',
    'functions.php',
    'index.php',
    'views/*.{php,html}',
    'views/**/*.{php,html}',
  ],
  theme: {
    extend: {
      colors: themeConfig.colors,
      fontFamily: {
        display: [...themeConfig.fonts.display, ...defaultTheme.fontFamily.serif],
        body: [...themeConfig.fonts.body, ...defaultTheme.fontFamily.sans],
        sans: [...themeConfig.fonts.sans, ...defaultTheme.fontFamily.sans],
        serif: [...themeConfig.fonts.serif, ...defaultTheme.fontFamily.serif],
      },
    },
  },
  plugins: [
    require('tailwind-scrollbar-hide'),
    require('tailwind-ratio'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ]
}

