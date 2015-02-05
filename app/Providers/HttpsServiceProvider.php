<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HttpsServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if ($this->app->request->isSecure()) {
			$this->app->url->forceSchema('https');
		}
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
