<?php namespace App\Apis\WindBot;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Exception\RequestException;

class WindBot {

	/**
	 * URL used to acess the WindBot reselling API.
	 */
	const RESELLER_URL = 'http://forums.tibiawindbot.com/reseller.php';

	/**
	 * GuzzleHTTP client.
	 * 
	 * @var GuzzleHttp\Client
	 */
	private $client;

	/**
	 * Default constructor.
	 * 
	 * @param string
	 */
	public function __construct($apiKey)
	{
		$this->client = new Client([
			'base_url' => self::RESELLER_URL,
			'defaults' => [
				'query' => [
					'resellerid' => $apiKey
				]
			]
		]);
	}

	/**
	 * Adds license days to the given WindBot account.
	 * 
	 * @param  string
	 * @param  string
	 * 
	 * @return PaymentResponse
	 */
	public function addLicenseDays($user, $days)
	{
		try {
			$response = $this->client->get(null, [
				'query' => [
					'days' => $days,
					'user' => $user
				]
			]);
		} catch (RequestException $e) {
			return new PaymentResponse($e->getResponse());
		}

		return new PaymentResponse($response);
	}

}