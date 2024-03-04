const fs = require('fs');
const path = require('path');

class SyncThemeConfigPlugin {
  constructor(options) {
    this.options = options;
  }

  apply(compiler) {
    compiler.hooks.emit.tapAsync('SyncThemeConfigPlugin', (compilation, callback) => {
      // Read the shared config file
      const themeConfig = require(this.options.configPath);

      // Logic to format the data for theme.json
      const themeJsonData = {
        version: themeConfig.version,
        settings: {
          colors: themeConfig.colors,
          typography: {
            fontSizes: themeConfig.fonts.fontSizes,
          }
        }
      };

      // Write to theme.json
      fs.writeFileSync(
        'theme.json',
        JSON.stringify(themeJsonData, null, 2)
      );

      callback();
    });
  }
}

module.exports = SyncThemeConfigPlugin;
