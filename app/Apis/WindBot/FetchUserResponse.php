<?php namespace App\Apis\WindBot;

use GuzzleHttp\Message\Response as GuzzleResponse;

class FetchUserResponse extends Response {

	/**
	 * Returned user.
	 * 
	 * @var object
	 */
	private $user;

	/**
	 * Default constructor.
	 * 
	 * @param GuzzleResponse
	 */
	public function __construct(GuzzleResponse $response)
	{
		parent::__construct($response);

		if (preg_match('/^User \'.+?\' not found\.$/', $this->getBody())) {
			$this->status = self::STATUS_INVALID_USER;
		} else {
			$this->status = self::STATUS_OK;
			$this->user = $response->json(['object' => true]);
		}
	}

	/**
	 * Get remaining balance.
	 * 
	 * @return int
	 */
	public function getUser()
	{
		return $this->user;
	}

}