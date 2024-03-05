const fs = require('fs');
const path = require('path');
const googleFontsHelper = require('google-fonts-helper');

const fontsListFile = path.join(__dirname, '../../.googlefonts.list');
const outputDir = path.join(__dirname, '../../public/fonts'); // Update this to your desired output directory

fs.readFile(fontsListFile, 'utf8', async (err, data) => {
  if (err) {
    console.error('Error reading the fonts list file:', err);
    return;
  }

  const fonts = data.split('\n').filter(Boolean);
  let fontsConstructor = {
    families: {}
  }
  fonts.forEach((font, index) => {
      const fontName = font
      fontsConstructor.families[fontName] = true
  });

  url = googleFontsHelper.constructURL(fontsConstructor);

  console.log('Downloading:', url);

  // Download the fonts
  try {
      const downloader = googleFontsHelper.download(url + '&display=swap', {
          base64: false,
          overwriting: false,
          outputDir: './',
          stylePath: 'src/styles/base/_fonts.scss',
          fontsDir: 'public/fonts',
          fontsPath: '../../public/fonts'
      });

      downloader.hook('download-font:before', (font) => {
        console.log(font)
      })
      
      downloader.hook('download-font:done', (font) => {
        console.log(font)
      })
      
      downloader.hook('download:start', () => {
        console.log('Downloading fonts...')
      })
      
      downloader.hook('download:complete', () => {
        console.log('Download fonts completed.')
      })

      await downloader.execute()
      console.log('Fonts downloaded successfully.');
  } catch (error) {
      console.error('Error downloading fonts:', error);
  }
});