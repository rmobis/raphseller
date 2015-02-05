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
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app->validator->extend('user', function($attribute, $value, $parameters) {
			$windbot = $this->app->make('App\Apis\WindBot\WindBot');

			$response = $windbot->fetchUser($value);

			if ($response->getStatus() === Response::STATUS_INVALID_USER) {
				return false;
			}

			$user = $response->getUser();
			
			return $user->usergroupid !== 3;
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
