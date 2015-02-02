<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	/**
	 * Order is awaiting return from PayPal webiste.
	 */
	const STATUS_PENDING  = 'pending';

	/**
	 * Order has been approved by the user.
	 */
	const STATUS_APPROVED = 'approved';

	/**
	 * Order has been approved by the user and the license has been delivered.
	 */
	const STATUS_DELIVERED = 'delivered';

	/**
	 * Cost, in U.S. dollars, of a 30 days license.
	 */
	const THIRTY_DAYS_LICENSE = 8;

	/**
	 * Cost, in U.S. dollars, of a 90 days license.
	 */
	const NINETY_DAYS_LICENSE = 18;

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'uuid';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['uuid', 'status', 'value'];

	/**
	 * Default constructor.
	 * 
	 * @param array
	 */
	public function __construct(array $attributes = array())
	{
		parent::__construct($attributes);

		$this->status = self::STATUS_PENDING;
	}

	/**
	 * License days attributer mutator.
	 * 
	 * @param int $value
	 */
	public function setLicenseDaysAttribute($value) {
		$this->attributes['license_days'] = $value;

		$this->value = $value == 30 ? self::THIRTY_DAYS_LICENSE : self::NINETY_DAYS_LICENSE;
	}

	/**
	 * Changes the status order to approved.
	 */
	public function approve()
	{
		$this->status = self::STATUS_APPROVED;
		$this->save();
	}

	/**
	 * Changes the status order to delivered.
	 */
	public function deliver()
	{
		$this->status = self::STATUS_DELIVERED;
		$this->save();
	}
}
