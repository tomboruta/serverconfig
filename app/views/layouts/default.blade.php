<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title> 
			@section('title') 
			@show 
		</title>

		@section('meta')
		@show

		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- bootstrap 3.0.2 -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- font Awesome -->
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Ionicons -->
		<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- nouislider -->
		<link href="css/jquery.nouislider.css" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
	</head>

	<body class="skin-blue">
		<header class="header">
            <a href="{{ URL::route('home') }}" class="logo">
                Server Config
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-right">
                    
                </div>
            </nav>

        </header>

		<!-- Navbar -->
		{{--
	          <ul class="nav navbar-nav">
				@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
					<li {{ (Request::is('users*') ? 'class="active"' : '') }}><a href="{{ URL::action('Sentinel\UserController@index') }}">Users</a></li>
					<li {{ (Request::is('groups*') ? 'class="active"' : '') }}><a href="{{ URL::action('Sentinel\GroupController@index') }}">Groups</a></li>
				@endif
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	            @if (Sentry::check())
				<li {{ (Request::is('users/show/' . Session::get('userId')) ? 'class="active"' : '') }}><a href="/users/{{ Session::get('userId') }}">{{ Session::get('email') }}</a></li>
				<li><a href="{{ URL::route('Sentinel\logout') }}">Logout</a></li>
				@else
		--}}
				{{--
				<li {{ (Request::is('login') ? 'class="active"' : '') }}><a href="{{ URL::route('Sentinel\login') }}">Login</a></li>
				<li {{ (Request::is('users/create') ? 'class="active"' : '') }}><a href="{{ URL::route('Sentinel\register') }}">Register</a></li>
				--}}
		{{--
				@endif
	          </ul>
	    --}}

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('layouts/notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>

		<!-- ./ container -->

		<!-- Javascripts
		================================================== -->
		<!-- jQuery 2.0.2 -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<!-- jQuery UI 1.10.3 -->
		<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
		<!-- Bootstrap -->
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Popover replacement -->
		<script src="js/plugins/bootstrapx-clickover.js" type="text/javascript"></script>
		<!-- iCheck -->
		<script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		<!-- nouislider -->
		<script src="js/jquery.nouislider.min.js" type="text/javascript"></script>
		<!-- AdminLTE App -->
		<script src="js/AdminLTE/app.js" type="text/javascript"></script>

		<script src="/js/serverConfig.js"></script>

		@section('javascript')
		@show

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-737315-30', 'serverconfig.io');
		  ga('send', 'pageview');

		</script>
	</body>
</html>
