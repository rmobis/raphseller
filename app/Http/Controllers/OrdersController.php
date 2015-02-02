<?php namespace App\Http\Controllers;

use Input;
use Request;

use App\Order;
use App\Apis\PayPal\PayPal;
use App\Apis\WindBot\WindBot;
use App\Http\Requests\StoreOrderRequest;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

use Illuminate\Support\Collection;

class OrdersController extends Controller {

	/**
	 * PayPal object.
	 * 
	 * @var App\Apis\PayPal\PayPal
	 */
	public $paypal;

	/**
	 * WindBot object.
	 * 
	 * @var App\Apis\WindBot\WindBot
	 */
	public $windbot;

	/**
	 * Default constructor.
	 * 
	 * @param App\PayPal\PayPal
	 */
	public function __construct(PayPal $paypal, WindBot $windbot)
	{
		$this->paypal = $paypal;
		$this->windbot = $windbot;
	}

	/**
	 * Show the form for creating a new order.
	 *
	 * @Get("/", as="order.create")
	 * @Get("/order/create", as="order.create")
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('pages.order.create');
	}
	
	/**
	 * @Get("/order/cancel", as="order.cancel")
	 *
	 * @return Response
	 */
	public function cancel()
	{
		return redirect(route('order.create'))->with([
			'warnings' => Collection::make([
				trans('order.failWarning')
			])
		]);
	}

	/**
	 * @Get("/order/approve", as="order.approve")
	 *
	 * @return Response
	 */
	public function approve()
	{
		$paymentId = Input::get('paymentId');
		$payerId   = Input::get('PayerID');

		$payment = $this->paypal->executePayment($paymentId, $payerId);

		$order = Order::find($payment->getTransactions()[0]->getInvoiceNumber());
		$order->approve();

		if ($this->windbot->addLicenseDays($order->user, $order->days))
		{
			$order->deliver();
			return view('pages.order.approve', compact('order'));
		}
		else
		{
			\Log::error($order);
			return view('pages.order.issue', compact('order'));
		}
	}

	/**
	 * Store a newly created order in storage.
	 *
	 * @Post("/order/store", as="order.store")
	 *
	 * @return Response
	 */
	public function store(StoreOrderRequest $request)
	{
		$days = intval(Input::get('license-days'));

		$order = new Order([
			'license_days' => $days,
			'email'        => Input::get('email'),
			'user'         => Input::get('username'),
			'ip'           => Request::getClientIp()
		]);

		$payment = $this->paypal->createPayment(
			trans('paypal.product', ['days' => $days]),
			$order->value
		);

		$order->uuid = $payment->getTransactions()[0]->getInvoiceNumber();
		$order->save();

		return redirect($payment->getApprovalLink());
	}


}
