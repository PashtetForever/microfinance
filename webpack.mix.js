const mix = require('laravel-mix')
const path = require('path')

mix.js('resources/js/app.js', 'public/js').vue();
mix.sass('resources/sass/app.scss', 'public/css').options({
  processCssUrls: false,
});

if(mix.inProduction()) {
  mix.version();
  mix.babel(['public/js/app.js'], 'public/js/app.es5.js');
  mix.webpackConfig({
    output: {
      publicPath: process.env.APP_SUBDIRECTORY
    },
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources/js')
      }
    }
  })
}

else {
  mix.sourceMaps(false, 'source-map')
  mix.browserSync(process.env.APP_URL);
}
