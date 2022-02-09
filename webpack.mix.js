let mix = require('laravel-mix');

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

  // mix.js("resources/assets/js/app.js", "public/js")
  // mix.sass("resources/assets/sass/app.scss", "public/css")

var scriptType = 'ts';

if (scriptType == 'ts') {

    mix.ts('resources/assets/js/app.ts', 'public/js')
     .sass('resources/assets/sass/app.scss', 'public/css');

} else {

  mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

}
