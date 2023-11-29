var path                = require('path');

const nodeExternals     = require('webpack-node-externals');
const htmlLoaderConfig  = require('html-loader');

const UglifyJSPlugin    = require('uglifyjs-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

//const extractCSS      = new ExtractTextPlugin('stylesheets/[name]-one.css');
const uglifyScript      = new UglifyJSPlugin();
const extractLESS       = new ExtractTextPlugin('css/theme.webpack.css');

module.exports = {
  entry: [
    './js/jquery.appear.js',
  	'./js/owl.carousel.min.js',
  	'./js/jquery.magnific-popup.min.js',
  	'./js/jquery.asPieProgress.min.js',
  	'./js/jquery.cookiebar.js',
  	'./js/jquery.countup.js',
  	'./js/jquery.cubeportfolio.min.js',
  	'./js/jquery.flickr.js',
  	'./js/fitvids.js',
    './js/tick.js',
  	'./inc/vendor/uikit/js/uikit-icons.min.js',
  	'./js/theme.js',
  	 './less/theme.less'
  ],
  module: {
    rules: [
      {
       test: /\.js$/,
    	exclude: /(node_modules|bower_components)/,
    	loader: 'babel-loader',
      },
      {
      	test: /\.css$/,
        exclude: /node_modules/,
      	loader: ['css-loader'],
      },
      {
      test: /\.less$/,
        use: extractLESS.extract({
            use: [{
                loader: "css-loader",
                options: { url: false }
            }, {
                loader: "less-loader"
            }],
            // use style-loader in development
            //fallback: "style-loader"
        })
      },
      {
      	test: /\.(eot|svg|ttf|woff|woff2)$/,
        exclude: /node_modules/,
      	loader: 'font-loader',
      },
      {
      	test: /\.svg$/,
        exclude: /node_modules/,
      	loader: ['html-loader'],
      },
    	{
      	test: /\.(gif|png|jpe?g|svg)$/i,
      	exclude: /node_modules/,
      	loaders: [
        	require.resolve("url-loader") + "?name=[path][name].[ext]"
      	]
      }
    ]
  },
  output: {
    filename: 'js/theme.webpack.js',
    path: path.resolve(__dirname, './'),
    libraryTarget: 'umd',
    publicPath: './'
  },
  target: 'node',
  externals: {jquery: 'jQuery', uikit: 'UIkit'},
  plugins: [
  	uglifyScript,
    extractLESS
  ]
}