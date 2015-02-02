<?php namespace App\Apis\PayPal;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

use Illuminate\Support\ServiceProvider;

class PayPalServiceProvider extends ServiceProvider {

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
		$this->app['App\Apis\PayPal\PayPal'] = $this->app->share(function ()
		{
			$apiContext = new ApiContext(
				new OAuthTokenCredential(
					env('PAYPAL_CLIENT_ID'),
					env('PAYPAL_CLIENT_SECRET')
				)
			);

			$apiContext->setConfig([
				'mode' => env('PAYPAL_SANDBOX') ? 'sandbox' : 'live',
				'log.LogEnabled' => true,
				'log.FileName' => base_path('storage/logs/paypal-' . date('Y-m-d') .'.log'),
				'log.LogLevel' => 'FINE',
				'validation.level' => 'log',
				'cache.enabled' => true,
			]);

			return new PayPal($apiContext);
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
			'App\Apis\PayPal\PayPal',
		];
	}

}
