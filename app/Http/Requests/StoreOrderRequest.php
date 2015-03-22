<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreOrderRequest extends Request {

	/**
	 * The input keys that should not be flashed on redirect. In this case, all
	 * of them, because having input sent back basically kills our workflow.
	 *
	 * @var array
	 */
	protected $dontFlash = [];

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'license-days' => [
				'required',
				'numeric',
				'in:30,90',
			],
			'email' => [
				'required',
				'email',
			],
			'username' => [
				'required',
				'regex:/^[ a-zA-z0-9]{3,}$/',
				'user',
			],
		];
	}

}
