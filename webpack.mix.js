const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue();
mix.sass('resources/sass/app.scss', 'public/css'); //todo: Стили не минифицируются

if(mix.inProduction()) {
  mix.version();
  mix.babel(['public/js/app.js'], 'public/js/app.es5.js')
  mix.webpackConfig({
    output: {
      publicPath: '/cabinet/public/'
    }
  });
} else {
  mix.sourceMaps(false, 'source-map')
  mix.browserSync('dynai.test');
}

/*if (process.env.APP_ENV === 'production') {
  mix.js('resources/js/app.js', 'public/js')
    .babel(['public/js/app.js'], 'public/js/app.es5.js')
    .sass('resources/sass/app.scss', 'public/css')
    .version();
  mix.webpackConfig({
    output: {
      filename: '[name].js',
      chunkFilename: 'js/[name].app.js',
      publicPath: '/cabinet/public/'
    }
  });
}
if (process.env.APP_ENV === 'staging') {
  mix.js('resources/js/app.js', 'public/js')
    .babel(['public/js/app.js'], 'public/js/app.es5.js')
    .sass('resources/sass/app.scss', 'public/css')
    .version();

  mix.webpackConfig({output: {filename: '[name].js', chunkFilename: 'js/[name].app.js', publicPath: '/test/public/'}});
}
if (process.env.APP_ENV === 'local') {
  //mix.browserSync('dynai.test')
  //mix.sourceMaps(false, 'source-map');

  mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')


}*/
