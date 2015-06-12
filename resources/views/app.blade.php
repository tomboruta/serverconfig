<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> 
			Server Config - A better starting point for your server
		</title>

		<meta name="description" content="Get a better starting point for your server over the default settings.">

		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- bootstrap 3.0.2 -->
		<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- font Awesome -->
		<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Ionicons -->
		<link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
	</head>

	<body class="skin-blue">
		<header class="header">
            <a href="/" class="logo">
                Server Config
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-right">
                    
                </div>
            </nav>

        </header>

		<!-- Container -->
		<div class="container">
			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>

		<!-- ./ container -->

		<!-- Javascripts
		================================================== -->
		<!-- jQuery 2.0.2 -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<!-- jQuery UI 1.10.3 -->
		<script src="/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
		<!-- Bootstrap -->
		<script src="/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Popover replacement -->
		<script src="/js/bootstrapx-clickover.js" type="text/javascript"></script>
		<!-- iCheck -->
		<script src="/js/icheck.min.js" type="text/javascript"></script>
		<!-- AdminLTE App -->
		<script src="/js/app.js" type="text/javascript"></script>

		<script src="/js/serverConfig.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				$('#emailsubscribe').submit(function(e){
					$('#emailsubscribebutton').prop('disabled',true);
					$('#emailsubscribeinidcator').html('<img src="/img/ajax-loader-small.gif">');
					e.preventDefault();
					var email = $("input#email").val();
					var dataString = 'email='+email;
		            $.ajax({
		                type: "POST",
		                url : "subscribe",
		                data : dataString,
		                success : function(data){
		                	$('#'+data.selector).html(data.msg);
		                }
		            },"json");
		            $('#emailsubscribebutton').prop('disabled',false);
		            $('#emailsubscribeinidcator').html('');
				});
			});
		</script>

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
