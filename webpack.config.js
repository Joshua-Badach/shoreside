const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const svgToMiniDataURI = require('mini-svg-data-uri');


module.exports = {
  //Change to production at delivery
  mode: "development",
  context: path.resolve(__dirname, "assets"),
  watch: true,
  plugins:[
    new MiniCssExtractPlugin({
      filename: "bundle.css",
      chunkFilename: "bundle-[id].css"
    }),
    // new svgToMiniDataURI({
    //   filename: "bundle.css",
    //   chunkFilename: "bundle-[id].css"
    // })
  ],
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: '../'
            }
          },
          "css-loader"
        ]
      },
      {
        test: /\.s[ac]ss$/i,
        exclude: /node-modules/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ]
      },
      {
        test: /\.(png|jpg|gif)$/i,
        use: [
          {
            loader: 'url-loader',
            options: {
              limit: 8192,
              mimetype: 'image/png'
            },
          },
        ],
      },
      {
        test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
        use: [{
          loader: 'url-loader',
          options: {
            limit: 10000,
            mimetype: 'image/svg+xml',
            // generator: (content) => svgToMiniDataURI(content.toString)
          }
        }]
      }
    ],
  },
  output: {
    filename: 'main.bundle.js',
    path: path.resolve(__dirname, "assets/dist")
  },
};