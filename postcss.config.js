const tailwindcss = require('tailwindcss');
const purgecss = require('@fullhuman/postcss-purgecss');
const cssnano = require('cssnano');
const autoprefixer = require('autoprefixer');
const tailwindConfig = require('./tailwind.config.js');

module.exports = {
  plugins: [
    tailwindcss('./tailwind.config.js'),
    cssnano({
      preset: 'default',
    }),
    purgecss({
      content: [...tailwindConfig.content]
    }),
    autoprefixer
  ]
}