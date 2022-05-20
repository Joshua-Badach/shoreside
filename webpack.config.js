const path = require('path')
const webpack = require('webpack')
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  //Change to production at delivery
  mode: "development",
  context: path.resolve(__dirname, "assets"),
  watch: true,
  plugins:[
    new MiniCssExtractPlugin({
      filename: "bundle.css",
      chunkFilename: "bundle-[id].css"
    })
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
        test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
        use: [{
          loader: 'url-loader',
          options: {
            limit: 10000,
            mimetype: 'image/svg+xml'
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