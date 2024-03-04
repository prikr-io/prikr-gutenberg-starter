const themeConfig = require('./theme.config');
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
      fontFamily: themeConfig.fonts,
    },
  },
  plugins: [
    require('tailwind-scrollbar-hide'),
    require('tailwind-ratio')
  ]
}

