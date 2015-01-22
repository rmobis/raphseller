<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;

class OrdersController extends Controller {

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
	 * Store a newly created order in storage.
	 *
	 * @Post("/order/store", as="order.store")
	 *
	 * @return Response
	 */
	public function store(StoreOrderRequest $request)
	{
		
	}
}
