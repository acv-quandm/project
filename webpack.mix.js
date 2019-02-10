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

// mix.js('resources/js/index.js', 'public/js/common.js')
// mix.sass('resources/sass/index.scss','public/css/style.css')

mix.js('resources/js/pages/lecturers.js', 'public/js/lecturers.js')
mix.js('resources/js/pages/departments.js', 'public/js/departments.js')
mix.js('resources/js/pages/drugs.js', 'public/js/drugs.js')
mix.js('resources/js/pages/healths.js', 'public/js/healths.js')
