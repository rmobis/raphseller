<?php namespace App\Apis\WindBot;


use Symfony\Component\Translation\TranslatorInterface;

use Illuminate\Validation\Validator as IlluminateValidator;

class Validator extends IlluminateValidator {

	/**
	 * The WindBot API client.
	 *
	 * @var WindBot
	 */
	protected $windbot;

	/**
	 * Create a new Validator instance.
	 *
	 * @param  WindBot  $windbot
	 * @param  \Symfony\Component\Translation\TranslatorInterface  $translator
	 * @param  array  $data
	 * @param  array  $rules
	 * @param  array  $messages
	 * @param  array  $customAttributes
	 * 
	 * @return void
	 */
	public function __construct(WindBot $windbot, TranslatorInterface $translator, array $data, array $rules, array $messages = array(), array $customAttributes = array())
	{
		parent::__construct($translator, $data, $rules, $messages, $customAttributes);

		$this->windbot = $windbot;
	}

    public function validateUser($attribute, $value, $parameters)
    {
        return $value == 'foo';
    }

}