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

mix.autoload({
    jquery:['$', 'jQuery', 'window.jQuery']
});

mix.postCss('resources/css/includes.css', 'public/css/app.css').options({processCssUrls:false});
mix.js('resources/js/app.js', 'public/js');

