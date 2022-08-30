const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const svgToMiniDataURI = require('mini-svg-data-uri');


module.exports = {
  //Change to production at delivery
  mode: "production",
  context: path.resolve(__dirname, "assets"),
  watch: true,
  plugins:[
    new webpack.ProvidePlugin({
      jQuery: 'jquery',
      jquery: 'jquery',
      $: 'jquery',
    }),
    new MiniCssExtractPlugin({
      filename: "bundle.css",
      chunkFilename: "bundle-[id].css"
    }),
  ],
  module: {
    rules: [
      // {
      //   test: /\.css$/,
      //   use: [
      //     {
      //       loader: MiniCssExtractPlugin.loader,
      //       options: {
      //         publicPath: '../'
      //       }
      //     },
      //     "css-loader"
      //   ]
      // },
      {
        test: /\.s[ac]ss$/i,
        exclude: /node-modules/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ]
      },
    ],
  },
  output: {
    filename: 'main.bundle.js',
    path: path.resolve(__dirname, "assets/dist")
  },
};