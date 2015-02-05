<?php namespace App\Apis\PayPal;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;

class PayPal {

	/**
	 * PayPal REST API context.
	 * 
	 * @var Paypal\Rest\ApiContext
	 */
	public $apiContext;

	/**
	 * Default constructor.
	 * 
	 * @param PayPal\Rest\ApiContext
	 */
	public function __construct(ApiContext $apiContext)
	{
		$this->apiContext = $apiContext;
	}

	/**
	 * Creates a payment for a given item with a given cost and returns it.
	 * 
	 * @param  string
	 * @param  float
	 * 
	 * @return PayPal\Api\Payment
	 */
	public function createPayment($itemName, $itemCost)
	{
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$item = new Item();
		$item->setName($itemName)
			->setCurrency('USD')
			->setQuantity(1)
			->setPrice($itemCost);

		$itemList = new ItemList();
		$itemList->setItems([$item]);

		$details = new Details();
		$details->setSubtotal($itemCost);

		$amount = new Amount();
		$amount->setCurrency('USD')
			->setTotal($itemCost)
			->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription($itemName)
			->setInvoiceNumber(uniqid());

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl(url('order/approve'))
			->setCancelUrl(url('order/cancel'));

		$payment = new Payment();
		$payment->setIntent('sale')
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setTransactions([$transaction]);

		$payment->create($this->apiContext);

		return $payment;
	}

	/**
	 * Executes a payment, collecting the money and making me rich. Returns the
	 * executed payment.
	 * 
	 * @param  string
	 * @param  string
	 * 
	 * @return PayPal\Api\Payment
	 */
	public function executePayment($paymentId, $payerId)
	{
		$payment = Payment::get($paymentId, $this->apiContext);

		$execution = new PaymentExecution();
		$execution->setPayerId($payerId);

		$result = $payment->execute($execution, $this->apiContext);

		return Payment::get($paymentId, $this->apiContext);
	}

}