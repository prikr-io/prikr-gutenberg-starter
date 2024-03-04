const path = require('path');
const themeConfig = require('./theme.config');
const SyncThemeConfigPlugin = require('./config/js/SyncThemeConfigPlugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const webpack = require('webpack');

const LOCAL_ENV_URL = 'http://localhost/' // should contain http: or https:
const DEV_MODE = process.env.NODE_ENV !== "production";

function getBlockEntries() {
  const entries = {};
  for (const block in themeConfig.blocks) {
    entries[block] = `./src/js/blocks/${themeConfig.blocks[block].js}`;
  }
  return entries;
}

const plugins = [
  new SyncThemeConfigPlugin({
    configPath: path.resolve(__dirname, 'theme.config.js')
  }),
  new MiniCssExtractPlugin({
    filename: !DEV_MODE ? "../css/[name].css" : "../css/[name].[contenthash].css",
    chunkFilename: !DEV_MODE ? "../css/[id].css" : "../css/[id].[contenthash].css",
  })
]

module.exports = {
  mode: 'development',
  entry: {
    bundle: './src/js/index.js',
    ...getBlockEntries(),
  },
  output: {
    path: path.resolve(__dirname, 'public/js'), // Directory to output files
    publicPath: '/js/', // Public URL of the output directory when referenced in a browser
    filename: '[name].min.js',
  },
  devtool: DEV_MODE ? 'source-map' : false,
  cache: false,
  context: __dirname,
  module: {
    rules: [{
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader'
        }
      },
      {
        test: /\.(scss|css)$/,
        exclude: /node_modules/,
        use: [
          DEV_MODE ? 'style-loader' : MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: {
              sourceMap: true,
            },
          },
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                config: "./postcss.config.js",
              },
              sourceMap: true,
            },
          }
        ],
      }
    ]
  },
  resolve: {
    extensions: ['.js', '.jsx']
  },
  devServer: {
    static: {
      directory: path.join(__dirname, 'public'),
      watch: {
        ignored: [
          /node_modules/,
          path.resolve(__dirname, 'public/js'),
          path.resolve(__dirname, 'public/css')
        ],
      },
    },
    devMiddleware: {
      writeToDisk: true, // Enable writing files to disk in dev mode
    },
    hot: true, // Enable Hot Module Replacement
    watchFiles: {
      paths: [
        './src/**/*.{js,jsx,ts,tsx}',
        './block-templates/**/*.html',
        './block-template-parts/**/*.html',
        './**/*.php', // Watch PHP files
        './**/**/*.php' // Watch PHP files
      ],
      options: {
        ignored: /node_modules/,
      },
    },
    proxy: [{
      context: () => true,
      target: LOCAL_ENV_URL, // Replace with your actual WordPress port
      changeOrigin: true,
      secure: false
    }],
    port: 3000,
  },
  optimization: {
    minimize: true,
    minimizer: [
      new TerserPlugin({
        terserOptions: {
          parse: {
            ecma: 8,
          },
          compress: {
            ecma: 5,
            warnings: false,
            comparisons: false,
            inline: 2,
          },
          mangle: {
            safari10: true,
          },
          output: {
            ecma: 5,
            comments: false,
            ascii_only: true,
          },
        },
      }),
      new CssMinimizerPlugin(),
    ],
  },
  plugins,
  watchOptions: {
    ignored: ['**/node_modules', 'node_modules', './node_modules']
  },
};