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
    // './src/**/*.{js,jsx,ts,tsx}',
    'block-templates/*.{php,html}',
    'block-template-parts/*.{php,html}',
    // include PHP files if you want Tailwind to scan for classes in PHP
    // './**/**/*.php'
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

