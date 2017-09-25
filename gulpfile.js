const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir.config.sourcemaps = true;

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix =>
{
    var assets       = 'resources/assets/',
        node_modules = 'node_modules/';

mix.sass('app.scss', 'public/css/app.css').webpack('app.js')
mix.sass('style.scss', 'public/css/style.css')
    /*
     * Version
     */
    .version(
        [
            'css/app.css',
            'js/app.js'
        ]
    );
}
);
