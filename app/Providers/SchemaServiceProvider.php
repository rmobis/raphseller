<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SchemaServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app->url->forceSchema(env('APP_SCHEMA'));
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
