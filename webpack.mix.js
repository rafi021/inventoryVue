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

mix.js([
    'resources/js/app.js',
    // 'dashboard_assets/vendors/js/vendors.min.js',
    // 'dashboard_assets/vendors/js/charts/apexcharts.min.js',
    // 'dashboard_assets/vendors/js/extensions/tether.min.js',
    // 'dashboard_assets/vendors/js/extensions/shepherd.min.js',
    // 'dashboard_assets/js/core/app-menu.js',
    // 'dashboard_assets/js/core/app.js',
    // 'dashboard_assets/js/scripts/components.js',
    // 'dashboard_assets/js/scripts/pages/dashboard-analytics.js',
    ], 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
