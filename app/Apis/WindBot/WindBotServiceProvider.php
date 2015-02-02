<?php namespace App\Apis\WindBot;

use Illuminate\Support\ServiceProvider;

class WindBotServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['App\Apis\WindBot\WindBot'] = $this->app->share(function ()
		{
			return new WindBot(env('WINDBOT_API_KEY'));
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'App\Apis\WindBot\WindBot',
		];
	}

}
