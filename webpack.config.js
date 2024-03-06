const path = require('path');
const fs = require('fs');
const SyncThemeConfigPlugin = require('./config/js/SyncThemeConfigPlugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const WriteFilePlugin = require('write-file-webpack-plugin');
const {
  CleanWebpackPlugin
} = require('clean-webpack-plugin');

const LOCAL_ENV_URL = 'http://localhost/' // should contain http: or https:
const DEV_MODE = process.env.NODE_ENV !== "production";

function getBlockEntries() {
  const blocksDir = './blocks';
  const blocks = fs.readdirSync(blocksDir, {
      withFileTypes: true
    })
    .filter(dirent => dirent.isDirectory())
    .map(dirent => dirent.name);

  const entries = {};
  blocks.forEach(block => {
    entries[block] = path.resolve(__dirname, `${blocksDir}/${block}/${block}.jsx`);
  });

  return entries;
}

const plugins = [
  new SyncThemeConfigPlugin({
    configPath: path.resolve(__dirname, 'tailwind.config.js')
  }),
  new MiniCssExtractPlugin({
    filename: !DEV_MODE ? "../css/[name].css" : "../css/[name].[contenthash].css",
    chunkFilename: !DEV_MODE ? "../css/[id].css" : "../css/[id].[contenthash].css",
  }),
  new WriteFilePlugin({
    test: /^(?!.*(hot)).*/,
  }),
  new CleanWebpackPlugin({
    cleanOnceBeforeBuildPatterns: [`${path.resolve(__dirname, 'public/js')}/*.hot-update.*`],
    dry: false,
    dangerouslyAllowCleanPatternsOutsideProject: true
  }),
]

module.exports = {
  mode: 'development',
  entry: {
    bundle: './src/js/index.js',
    ...getBlockEntries(),
  },
  output: {
    path: path.resolve(__dirname, 'public/js'), // Directory to output files
    filename: '[name].min.js',
  },
  devtool: DEV_MODE ? 'source-map' : false,
  cache: !DEV_MODE,
  context: __dirname,
  module: {
    rules: [{
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env', '@babel/preset-react']
          }
        }
      },
      {
        // Extract any SCSS content and minimize
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              importLoaders: 1
            }
          },
          {
            loader: 'postcss-loader'
          },
          {
            loader: 'sass-loader',
          }
        ]
      },
      {
        // Extract any CSS content and minimize
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              importLoaders: 1
            }
          },
          {
            loader: 'postcss-loader'
          }
        ]
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        type: 'asset/resource',
        generator: {
          filename: 'fonts/[name][ext]' // Output fonts in a 'fonts' directory
        }
      },
    ]
  },
  stats: {
    colors: true
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
    hot: DEV_MODE,
    watchFiles: {
      paths: [
        './src/**/*.{js,jsx,ts,tsx}',
        './**/*.{html,php}',
        './**/**/*.{html,php}',
        'theme.config.js'
      ],
      options: {
        ignored: [
          /node_modules/,
          /blocks/
        ]
      },
    },
    proxy: [{
      context: () => true,
      target: LOCAL_ENV_URL, // Replace with your actual WordPress port
      changeOrigin: false,
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