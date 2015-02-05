@extends('layout')

@section('content')
<div class="inner cover">
	<h1>{{ trans('order.issueTitle') }}</h1>
	<p>{!! trans('order.issueApproved') !!}</p>
	<p>
		@if($status == \App\Apis\WindBot\WindBotResponse::STATUS_EXTERNAL_ERROR)
			{!! trans('order.externalIssueText') !!}
		@elseif($status == \App\Apis\WindBot\WindBotResponse::STATUS_INVALID_USER)
			{!! trans('order.invalidUserText', ['user' => $order->user]) !!}
		@elseif($status == \App\Apis\WindBot\WindBotResponse::STATUS_NO_BALANCE)
			{!! trans('order.noBalanceText') !!}
		@endif
	</p>
	<p>{!! trans('order.issueContact') !!}</p>
</div>
@stop