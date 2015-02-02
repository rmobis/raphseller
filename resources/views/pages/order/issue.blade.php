@extends('layout')

@section('content')
<div class="inner cover">
	<h1>{{ trans('order.issueTitle') }}</h1>
	<p>{!! trans('order.issueText') !!}</p>
	<p>{!! trans('order.issueContact') !!}</p>
</div>
@stop

@section('extraScripts')
@stop