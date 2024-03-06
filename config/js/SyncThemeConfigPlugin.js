const fs = require('fs');
const path = require('path');

class SyncThemeConfigPlugin {
  constructor(options) {
    this.options = options;
  }

  apply(compiler) {
    compiler.hooks.emit.tapAsync('SyncThemeConfigPlugin', (compilation, callback) => {
      // Read the shared config file
      const tailwind = require(this.options.configPath);
      const config = tailwind.theme;

      // Logic to format the data for theme.json
      const themeJsonData = {
        version: 2,
        "$schema": "https://schemas.wp.org/trunk/theme.json",
        settings: {
          background: {
            backgroundImage: true
          },
          layout: config.layout,
          color: {
            custom: false,
            customDuotone: false,
            customGradient: false,
            defaultDuotone: false,
            defaultGradients: false,
            defaultPalette: false,
            duotone: [],
            palette: [
              {
                "color": "inherit",
                "name": "Inherit",
                "slug": "inherit"
              },
              {
                "color": "currentcolor",
                "name": "Current",
                "slug": "current"
              },
              {
                "color": "transparent",
                "name": "Transparent",
                "slug": "transparent"
              },
              ...themeJsonPalette(config.extend.colors)
            ]
          },
          typography: {
            lineHeight: true,
            customFontSize: false,
            textTransform: false,
            letterSpacing: false,
            fontFamilies: themeJsonFontFamilies(config.fontFamily),
            fontSizes: themeJsonFontSizes(config.fontSize)
          },
          spacing: {
            padding: true,
            margin: true,
            units: [
              'px',
              '%',
              'em',
              'rem',
              'vw',
              'vh'
            ]
          },
        },
        styles: {
          typography: {
            fontFamily: getDefaultFontFamilyStyle(config.fontFamily)
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

/**
 * Generate colors from tailwind.config.js in Theme.json
 */
const themeJsonPalette = (colors) => Object.entries(colors).flatMap(([colorName, colorValues]) => {
  // Check if the color value is an object (multiple shades) or a single color
  if (typeof colorValues === 'object' && colorValues !== null) {
    // Iterate over shades of color
    return Object.entries(colorValues).map(([shade, colorCode]) => ({
      slug: `${colorName}-${shade}`, // e.g., "primary-50"
      color: colorCode, // e.g., "#fef5fd"
      name: `${colorName.charAt(0).toUpperCase() + colorName.slice(1)} ${shade}` // Capitalize the color name and append the shade
    }));
  } else {
    // Single color
    return [{
      slug: colorName,
      color: colorValues,
      name: colorName.charAt(0).toUpperCase() + colorName.slice(1)
    }];
  }
});

/**
 * Generate font families from tailwind.config.js in Theme.json
 */
const themeJsonFontFamilies = (fontFamilies) => {
  const defaultTheme = require('tailwindcss/defaultTheme');
  const combinedFonts = {
    ...defaultTheme.fontFamily, // Tailwind's default fonts
    ...fontFamilies // Your custom fonts
  };

  // Create a set to store unique font families
  const uniqueFontFamilies = new Set();

  Object.values(combinedFonts).forEach(fontFamily => {
    // Ensure the value is an array (could be a string or array)
    const fontArray = Array.isArray(fontFamily) ? fontFamily : [fontFamily];
    uniqueFontFamilies.add(fontArray.join(', '));
  });

  const themeJsonFontFamilies = Array.from(uniqueFontFamilies).map((fontFamily, index) => {
    const firstFont = fontFamily.split(',')[0].trim(); // Get the first font from the font family string
    return {
      fontFamily: fontFamily,
      slug: firstFont.toLowerCase().replace(/\s+/g, '-'), // Create a slug from the first font name
      name: firstFont // Use the first font name as the name
    };
  });

  return themeJsonFontFamilies;
}

/**
 * Generate font sizes from tailwind.config.js for Theme.json
 */
const themeJsonFontSizes = (fontSizes) => {
  return Object.entries(fontSizes).map(([key, value]) => {
    return {
      name: key, // the key itself is used as the name
      size: value, // the value from tailwind config
      slug: key // the key can also be used as the slug
    };
  });
};

/**
 * Get the default font family for theme.json styles section from tailwind.config.js
 */
const getDefaultFontFamilyStyle = (fontFamilies) => {
  // Assuming the 'default' key is set and it's an array
  const defaultFontFamily = fontFamilies.default ? fontFamilies.default[0] : 'inherit';
  
  // Format as CSS variable. Assuming 'roboto' is part of your default fonts list
  const cssVarName = defaultFontFamily.toLowerCase().replace(/\s+/g, '-'); // e.g., 'roboto'
  return `var(--wp--preset--font-family--${cssVarName}) !important`;
};



module.exports = SyncThemeConfigPlugin;
