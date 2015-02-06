<?php namespace App\Apis\WindBot;

use GuzzleHttp\Message\Response as GuzzleResponse;

class PaymentResponse extends Response {

	/**
	 * Remaining balance.
	 * 
	 * @var int
	 */
	private $balance;

	/**
	 * Default constructor.
	 * 
	 * @param GuzzleResponse
	 */
	public function __construct(GuzzleResponse $response)
	{
		parent::__construct($response);

		if (preg_match(
			'/^Payment made successfully\. Remaining balance: (\-?\d+) \/ \-\d+ BRL$/',
			$this->getBody(),
			$matches	
		)) {
			$this->status = self::STATUS_OK;
			$this->balance = intval($matches[1]);
		} else if (preg_match(
			'/^Not enough money to make this purchase\. Remaining balance: (\-?\d+) \/ \-\d+ BRL$/',
			$this->getBody(),
			$matches
		)) {
			$this->status = self::STATUS_NO_BALANCE;
			$this->balance = intval($matches[1]);
		} else if (preg_match('/^User \'.+?\' not found\.$/', $this->getBody())) {
			$this->status = self::STATUS_INVALID_USER;
		}
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