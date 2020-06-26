const webpack = require('webpack')
const path = require('path')
const TerserPlugin = require('terser-webpack-plugin')


module.exports = {
    mode: 'development',
    entry: {
        main: './assets/js/main.js'
    },
    devtool: 'inline-source-map',
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['source-map-loader', 'babel-loader'],
                enforce: 'pre'
            },
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            }
        ]
    },
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin()],
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'dist'),
    }
}
