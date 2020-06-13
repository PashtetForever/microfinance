const mix = require('laravel-mix');


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version();

if(process.env.APP_ENV === 'production') {
  mix.webpackConfig({ output: { filename: '[name].js', chunkFilename: 'js/[name].app.js', publicPath: '/cabinet/public/' } });
}
if(process.env.APP_ENV === 'staging') {
  mix.webpackConfig({ output: { filename: '[name].js', chunkFilename: 'js/[name].app.js', publicPath: '/test/public/' } });
}
if(process.env.APP_ENV === 'local') {
  mix.browserSync('localhost')
  mix.sourceMaps(true,'source-map');
}
