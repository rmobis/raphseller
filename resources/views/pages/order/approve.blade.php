@extends('layout')

@section('content')
<div class="inner cover">
	<h1>{{ trans('order.congratulations') }}</h1>
	<p>{!! trans('order.paymentApproved', ['days' => $order->license_days, 'account' => $order->user]) !!}</p>
	<p>{!! trans('order.helpInfo') !!}</p>
</div>
@stop