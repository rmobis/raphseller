var elixir = require('laravel-elixir');
require('laravel-elixir-jshint');

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

elixir(function(mixx) {
	mixx.sass('raphseller.scss')
		.jshint([
			'public/js/**/*.js',
    		'!public/js/vendor/**/*.js'
    	])
		.copy(
			'vendor/bower_components/jquery/dist/jquery.min.js',
			'public/js/vendor/jquery.js'
		)
		.copy(
			'vendor/bower_components/bootstrap-sass-official/assets/fonts/bootstrap',
			'public/css/fonts'
		)
		.copy(
			'vendor/bower_components/bootstrap-sass-official/assets/stylesheets',
			'resources/assets/sass/vendor'
		)
});
