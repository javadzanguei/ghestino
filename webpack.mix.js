const mix = require('laravel-mix');
mix.webpackConfig({stats: {children: true,},});

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

mix.js('resources/js/app.js', 'public/assets/js')
    .js('resources/js/flasher.min.js', 'public/assets/js')
    .js('resources/js/mds.bs.datetimepicker.js', 'public/assets/js')
    .js('resources/js/num2persian.min.js', 'public/assets/js')
    // .js('resources/js/pusher-enable.js', 'public/assets/js')
    .sass('resources/scss/bootstrap-custom-ltr.scss', 'public/assets/css')
    .postCss('resources/css/app.css', 'public/assets/css')
    .postCss('resources/css/home.css', 'public/assets/css')
    .postCss('resources/css/panel.css', 'public/assets/css')
    .postCss('resources/css/fonts.css', 'public/assets/css')
    .postCss('resources/css/mds.bs.datetimepicker.style.css', '/public/assets/css')
    .postCss('resources/css/installment.css', '/public/assets/css')
    .copyDirectory('resources/fonts', 'public/assets/fonts')
    .copyDirectory('resources/img', 'public/assets/images')
