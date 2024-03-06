const plugin = require('tailwindcss/plugin');
const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    'src/js/*.js',
    'src/js/**/*.js',
    'footer.php',
    'header.php',
    'index.php',
    'functions.php',
    'blocks/**/*.{php,html}',
    'patterns/*.{php,html}',
    'block-template-parts/*.{php,html}',
    'block-templates/*.{php,html}',
  ],
  theme: {
    layout: {
      contentSize: '768px',
      wideSize: '1440px',
    },
    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl: '1440px',
    },
    fontFamily: {
      sans: ['Roboto', ...defaultTheme.fontFamily.sans],
      serif: ['Zilla Slab', ...defaultTheme.fontFamily.serif],
      display: ['Zilla Slab', ...defaultTheme.fontFamily.serif],
      body: ['Roboto', ...defaultTheme.fontFamily.sans]
    },
    fontSize: {
      'xs': '.75rem',
      'sm': '.875rem',
      'base': '1rem',
      'lg': '1.125rem',
      'xl': '1.25rem',
      '2xl': '1.5rem',
      '3xl': '1.875rem',
      '4xl': '2.25rem',
      '5xl': '3rem',
      '6xl': '3.75rem',
      '7xl': '4.rem',
      '8xl': '6rem',
      '9xl': '8rem',
    },
    extend: {
      colors: {
        primary: {
          '50': '#fef5fd',
          '100': '#fdeafa',
          '200': '#fad4f4',
          '300': '#f5b2e8',
          '400': '#ee84d7',
          '500': '#df49be',
          '600': '#c534a2',
          '700': '#a32883',
          '800': '#85236a',
          '900': '#6d2257',
          '950': '#480a35',
        },
        secondary: {
          '50': '#eefdfc',
          '100': '#d3fafa',
          '200': '#adf4f3',
          '300': '#74ebec',
          '400': '#49dcdf',
          '500': '#19bcc1',
          '600': '#1798a3',
          '700': '#1a7984',
          '800': '#1e626c',
          '900': '#1d525c',
          '950': '#0d373f',
        }
      },
    }
  },
  // safelist: [
  //   {
  //     pattern: /^has-/,
  //   }
  // ],
  plugins: [
    require('tailwind-scrollbar-hide'),
    require('tailwind-ratio'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    plugin(function ({addUtilities, theme, variants}) {
      const colors = theme('colors');
      const colorUtilities = Object.keys(colors).reduce((acc, color) => {
        if (typeof colors[color] === 'string') {
          acc[`.has-${color}`] = {
            'color': colors[color],
          };
          acc[`.has-${color}-background-color`] = {
            'background-color': colors[color],
          };
        } else {
          Object.keys(colors[color]).forEach((shade) => {
            acc[`.has-${color}-${shade}-background-color`] = {
              'background-color': colors[color][shade],
            };
          });
        }
        return acc;
      }, {});
      addUtilities(colorUtilities, variants('backgroundColor'));
    }),
  ]
}