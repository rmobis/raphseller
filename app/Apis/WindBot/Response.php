<?php namespace App\Apis\WindBot;

use GuzzleHttp\Message\Response as GuzzleResponse;

abstract class Response {

	/**
	 * License days were succesfully added.
	 */
	const STATUS_OK = 0;

	/**
	 * The was an issue with WindBot's API server.
	 */
	const STATUS_EXTERNAL_ERROR = 1;

	/**
	 * The user does not exist.
	 */
	const STATUS_INVALID_USER = 2;

	/**
	 * We are out of balace.
	 */
	const STATUS_NO_BALANCE = 3;

	/**
	 * Request status.
	 * 
	 * @var int
	 */
	protected $status;

	/**
	 * Response body.
	 * 
	 * @var string
	 */
	private $body;

	/**
	 * Default constructor.
	 * 
	 * @param GuzzleResponse
	 */
	public function __construct(GuzzleResponse $response)
	{
		if ($response->getStatusCode() !== 200) {
			$this->status = self::STATUS_EXTERNAL_ERROR;
			return;
		}

		$this->body = $this->sanitizeText((string) $response->getBody());
	}

	/**
	 * Sanitizes the input text, removing all unnecessary spaces.
	 * 
	 * @param  string
	 * 
	 * @return string
	 */
	protected function sanitizeText($text)
	{
		return trim($text);
	}

	/**
	 * Get response status.
	 * 
	 * @return int
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Get response body.
	 * 
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}

}