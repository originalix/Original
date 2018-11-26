var webpack = require('webpack');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')

module.exports = {
    entry: './main.js',
    output: {
        filename: 'bundle.js'
    },

    plugins: [
        new UglifyJsPlugin()
    ]
};
