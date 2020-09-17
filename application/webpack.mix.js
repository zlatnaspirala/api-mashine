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

 /*
// Merge with default laravel-mix config.
mix.webpackConfig({
    module: {
      rules: [
        { test: /\.tsx?$/, loader: "ts-loader" }
      ]
    }
});
*/


  // mix.js("resources/assets/js/app.js", "public/js")
  // mix.sass("resources/assets/sass/app.scss", "public/css")

  mix.webpackConfig({
    module: {
      rules: [
        {
          test: /\.ts?$/,
          loader: "ts-loader",
          options: { appendTsSuffixTo: [/\.vue$/] },
          exclude: /node_modules/
        }
      ]
    },
     resolve: {
      extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"]
    }
  });


 // move to global config for web app after all.
var scriptType = 'ts';


if (scriptType == 'ts') {

  mix.ts('resources/assets/js/app.ts', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

} else {

  mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

}
