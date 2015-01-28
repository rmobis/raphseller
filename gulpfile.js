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
	mixx
		/* SASS/CSS */
		.sass('raphseller.scss')
		.copy(
			'vendor/bower_components/bootstrap-sass-official/assets/fonts/bootstrap',
			'public/css/fonts'
		)
		.copy(
			'vendor/bower_components/bootstrap-sass-official/assets/stylesheets',
			'resources/assets/sass/vendor'
		)
		
		/* JavaScript */
		.jshint([
			'resources/assets/js/**/*.js'
    	])
		.scripts([
			'js/vendor/bootstrap-alert.js',
			'js/vendor/jquery.ba-throttle-debounce.js'
		], null, 'public/js/raphseller.js')
		.copy(
			'vendor/bower_components/jquery/dist/jquery.min.js',
			'public/js/vendor/jquery.js'
		)
		.copy(
			'vendor/bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/bootstrap-alert.js',
			'public/js/vendor/bootstrap-alert.js'
		)
		.copy(
			'vendor/bower_components/jquery-throttle-debounce/jquery.ba-throttle-debounce.js',
			'public/js/vendor/jquery.ba-throttle-debounce.js'
		)
		.copy(
			'resources/assets/js',
			'public/js'
		)

		/* Images */
		.copy(
			'resources/assets/img',
			'public/img'
		)

		/* Cache Busting */
		.version([
			'public/css/raphseller.css',
			'public/js/raphseller.js',
			'public/js/pages/order.create.js',
		]);
});
