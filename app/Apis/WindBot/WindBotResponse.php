<?php namespace App\Apis\WindBot;

use GuzzleHttp\Message\Response;

class WindBotResponse {

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
	private $status;

	/**
	 * Remaining balance.
	 * 
	 * @var int
	 */
	private $balance;

	/*
	 * Default constructor.
	 * 
	 * @param string
	 */
	public function __construct(Response $response)
	{
		if ($response->getStatusCode() !== 200) {
			$this->status = self::STATUS_EXTERNAL_ERROR;
			return;
		}

		$text = (string) $response->getBody();

		$text = $this->sanitizeText($text);

		if (preg_match(
			'/^Payment made successfully\. Remaining balance: (\-?\d+) \/ \-200 BRL$/',
			$text,
			$matches
		)) {
			$this->status = self::STATUS_OK;
			$this->balance = intval($matches[1]);
		} else if (preg_match(
			'/^Not enough money to make this purchase\. Remaining balance: (\-?\d+) \/ \-200 BRL$/',
			$text,
			$matches
		)) {
			$this->status = self::STATUS_NO_BALANCE;
			$this->balance = intval($matches[1]);
		} else if (preg_match('/^User \'.+?\' not found\.$/', $text)) {
			$this->status = self::STATUS_INVALID_USER;
		}
	}

	/**
	 * Sanitizes the input text, removing all unnecessary spaces.
	 * 
	 * @param  string
	 * 
	 * @return string
	 */
	private function sanitizeText($text)
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
	 * Get remaining balance.
	 * 
	 * @return int
	 */
	public function getBalance()
	{
		return $this->balance;
	}

}