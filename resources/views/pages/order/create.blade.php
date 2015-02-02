@extends('layout')

@section('content')
<div class="inner cover">
	{!! Form::open(['route' => 'order.store']) !!}
		<h1 class="cover-heading">{{ trans('order.stepOne') }}</h1>
		<div class="step step-one">
			<input type="hidden" id="license-days" name="license-days">
			<div class="license" data-days="30">
				<p>WindBot - {{ trans('order.licenseDays', ['days' => 30]) }}</p>
				<img src="/img/windbot-logo.png">
				<p>${{ App\Order::THIRTY_DAYS_LICENSE }}</p>
			</div>
			<div class="license" data-days="90">
				<p>WindBot - {{ trans('order.licenseDays', ['days' => 90]) }}</p>
				<img src="/img/windbot-tri-logo.png">
				<p>${{ App\Order::NINETY_DAYS_LICENSE }}</p>
			</div>
		</div>
		<div class="step step-two">
			{!! Form::email('email', null, [
				'placeholder'  => trans('order.emailPlaceholder'),
				'class'        => 'input email',
				'autocomplete' => 'off',
				'required',
			]) !!}
		</div>
		<div class="step-separator"></div>
		<div class="step step-three">
			{!! Form::text('username', null, [
				'placeholder'  => trans('order.usernamePlaceholder'),
				'class'        => 'input forum-name',
				'autocomplete' => 'off',
				'required',
			]) !!}
		</div>
		<div class="step-separator"></div>
		<div class="step step-four">
			{!! Form::submit(trans('order.makePayment'), ['class' => 'btn btn-lg btn-default btn-pay']) !!}
		</div>
	{!! Form::close() !!}
</div>
@stop

@section('extraScripts')
<script>
	window.LANG = $.extend(window.LANG || {}, {
		STEP_ONE   : {!! json_encode(trans('order.stepOne')) !!},
		STEP_TWO   : {!! json_encode(trans('order.stepTwo')) !!},
		STEP_THREE : {!! json_encode(trans('order.stepThree')) !!},
		STEP_FOUR  : {!! json_encode(trans('order.stepFour')) !!}
	});
</script>
<script src="{{ elixir('js/pages/order.create.js') }}"></script>
@stop