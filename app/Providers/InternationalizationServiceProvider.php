<?php namespace App\Providers;

use Aura\Accept\AcceptFactory;
use Illuminate\Support\ServiceProvider;

class InternationalizationServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$accept = (new AcceptFactory($_SERVER))->newInstance();
		$language = $accept->negotiateLanguage(['en', 'pl', 'es']);

		if ($language) {
			$this->app['translator']->setLocale($language->getValue());
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
