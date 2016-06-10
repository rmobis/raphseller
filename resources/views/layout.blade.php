<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="RaphSeller - WindBot License Reseller">
		<meta name="author" content="Raphael Mobis Tacla">

		<link rel="icon" href="/favicon.ico">

		<title>RaphSeller - WindBot License Reseller</title>

		<!-- Page styles -->
		<link href="{{ elixir('css/raphseller.css') }}" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Hotjar Tracking Code for http://raphseller.com -->
		<script>
			(function(h,o,t,j,a,r){
				h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
				h._hjSettings={hjid:229601,hjsv:5};
				a=o.getElementsByTagName('head')[0];
				r=o.createElement('script');r.async=1;
				r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
				a.appendChild(r);
			})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
		</script>
	</head>

	<body>
		<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<div class="site-wrapper">

			<div class="site-wrapper-inner">

				<div class="cover-container">

					<div class="masthead clearfix">
						<div class="inner">
							<h3 class="masthead-brand">
								RaphSeller
								<span class="release">&beta;</span>
							</h3>

							<nav>
								<ul class="nav masthead-nav">
									<li @if(Route::is('order.create') || Route::is('order.approve')) class="active" @endif>
										<a href="{{ route('order.create') }}">{{ trans('header.menu-store') }}</a>
									</li>
									<li @if(Route::is('help.index')) class="active" @endif>
										<a href="{{ route('help.index') }}">{{ trans('header.menu-help') }}</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>

					@if($errors->count() > 0)
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
							<strong>Ooops!</strong>
							@foreach($errors->all() as $error)
								<br>{{ $error }}
							@endforeach
						</div>
					@endif

					@if($warnings = Session::get('warnings', false))
						<div class="alert alert-warning alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
							<strong>Ohh...</strong>
							@foreach($warnings->all() as $warning)
								<br>{{ $warning }}
							@endforeach
						</div>
					@endif

					@yield('content')

					<div class="mastfoot">
						<div class="inner">
							<p>
								{!! trans('footer.line-one') !!}
							</p>
							<p>
								{!! trans('footer.line-two') !!}
							</p>
						</div>
					</div>

				</div>

			</div>

		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery.js"><\/script>')</script>
		<script src="{{ elixir('js/raphseller.js') }}"></script>

		@yield('extraScripts')

		<!-- Google Analytics -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-58686281-1','auto');ga('send','pageview');
        </script>
	</body>
</html>
