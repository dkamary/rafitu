const mix = require('laravel-mix');

/*
    |--------------------------------------------------------------------------
    | Mix Asset Management
    |--------------------------------------------------------------------------
    |
    | Mix provides a clean, fluent API for defining some Webpack build steps
    | for your Laravel applications. By default, we are compiling the CSS
    | file for the application as well as bundling up all the JS files.
    |
 */

mix
    .sass('resources/sass/frontoffice.scss', 'public/assets/css', {
        sassOptions: {
            outputStyle: 'compressed'
        }
    })
    .sass('resources/sass/backoffice.scss', 'public/assets/css', {
        sassOptions: {
            outputStyle: 'compressed'
        }
    })
    .js('resources/js/frontoffice.js', 'public/assets/js')
    .js('resources/js/backoffice.js', 'public/assets/js')
    .js('resources/js/ride.js', 'public/assets/js')
    .react()
    .sourceMaps();

mix.webpackConfig({
    stats: {
        children: true,
    },
});
