const path = require('path');
const themeConfig = require('./theme.config');
const SyncThemeConfigPlugin = require('./config/js/SyncThemeConfigPlugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const WriteFilePlugin = require('write-file-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const LOCAL_ENV_URL = 'http://localhost/' // should contain http: or https:
const DEV_MODE = process.env.NODE_ENV !== "production";

function getBlockEntries() {
  const entries = {};
  for (const block in themeConfig.blocks) {
    entries[block] = `./blocks/${block}/${themeConfig.blocks[block].js}`;
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
        test: /\.(scss|css)$/,
        exclude: /node_modules/,
        use: [
          DEV_MODE ? 'style-loader' : MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: {
              sourceMap: DEV_MODE,
            },
          },
          {
            loader: "sass-loader",
            options: {
              sourceMap: DEV_MODE,
            },
          },
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                config: "./postcss.config.js",
              },
              sourceMap: DEV_MODE,
            },
          },
          
        ],
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        type: 'asset/resource',
        generator: {
          filename: 'fonts/[name][ext]'  // Output fonts in a 'fonts' directory
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