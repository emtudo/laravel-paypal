var elixir = require('laravel-elixir');
require('laravel-elixir-livereload');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var distJs="../../../public/js/dist/";
var js="../../../public/js/";
var node="../../../node_modules/";
var assets="public/assets/";

elixir(function(mix) {
   mix.styles([
       node+"bootstrap/dist/css/bootstrap.css",
       node+"font-awesome/css/font-awesome.css",
       node+"sweetalert/dist/sweetalert.css",
       "../../../public/css/modalFullscreen.css"
   ], assets+"css/app.css");

   mix.scripts([
       node+"jquery/dist/jquery.js",
       node+"bootstrap/dist/js/bootstrap.js",
       node+"angular/angular.js",
       node+"sweetalert/dist/sweetalert-dev.js",
       distJs+"flashMessage.js",
   ], assets+"js/dist.js");

   mix.scripts([
       js+"app.js"
   ], assets+"js/app.js");

//	mix.livereload();
});

