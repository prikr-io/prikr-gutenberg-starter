// const purgecss = require('@fullhuman/postcss-purgecss')({
//   content: [
//     './src/**/*.html',
//     './src/**/*.php',
//     './src/**/*.js',
//   ],

//   // Include any special characters you're using in this regular expression
//   defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
// });

module.exports = {
  plugins: [
    // require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
  ],
};