@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Server Config - Better defaults for LAMP (Linux Apache MySQL PHP) servers
@stop

{{-- Content --}}
@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading"><h4>Select Server Options</h4></div>
				<div class="panel-body">
					<div class="selection-group server-selection">
						<span class="server-options-stripe-label">
						    Memory
						</span>
						<span id="memoryButtons"></span>
					</div>
					<div class="selection-group os-selection">
						<span class="server-options-stripe-label">
							OS
						</span>
						<span id="osButtons"></span>
					</div>
					<div class="selection-group dataStore-selection">
						<span class="server-options-stripe-label">
							Data Store
						</span>
						<span id="dataStoreButtons"></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h2>Initial Settings for a <span class="displayServerSize">1GB</span> Server running on <span class="displayOS">Ubuntu</span></h2>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 col-xs-12">
			<div class="well">
				<form class="" role="form">
					<h3>Apache</h3>
					<span id="apache2Inputs"></span>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="well">
				<form class="" role="form">
					<h3>PHP</h3>
					<span id="phpInputs"></span>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="well">
				<form class="" role="form">
					<h3 class="datastoreTitle"></h3>
					<span id="dataStoreInputs"></span>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Change these Apache settings<br>
					<em>/etc/apache2/apache2.conf</em>
				</div>
				<div class="panel-body">
					&lt;IfModule mpm_prefork_module&gt;
					<div id="webserverSettings"></div>
					&lt;/IfModule&gt;
<!--
MaxClients = (Memory - other running stuff) / average size of apache process
-->
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Change these PHP settings<br>
					<em>/etc/php5/apache2/php.ini</em>
				</div>
				<div class="panel-body">
					<div id="serverSideLanguageSettings"></div>
{{--
<!--
php_error_reporting = 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR';
php_display_errors = 'Off';
php_log_errors = 'On';
php_error_log = '/var/log/php/error.log';
php_register_globals = 'Off';
-->
--}}
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Change these <span class="datastoreTitle"></span> settings<br>
					<em>/etc/mysql/my.cnf</em>
				</div>
				<div class="panel-body">
					[mysqld]<br>
					...
					<div id="dataStoreSettings"></div>
					...

{{--
<!--
If using just MyISAM, set key_buffer_size to 20% of _available_ RAM. (Plus innodb_buffer_pool_size=0) 

myisam:
key_buffer_size + (read_buffer_size + sort_buffer_size)*max_connections = total_memory
key_buffer = 16K
max_allowed_packet = 1M
thread_stack = 64K
table_cache = 4
sort_buffer = 64K
net_buffer_length = 2K


If using just InnoDB, set innodb_buffer_pool_size to 70% of _available_ RAM. (Plus key_buffer_size = 10M, small, but not zero.) 

innodb:
Innodb_buffer_pool_size	70-80% of system memory	Most Important (if possible, this should be 10% bigger than you databases)
innodb_flush_log_trx_commmit	2	Batching writes each 1 second, instead of instantly
innodb_flush_method 	O_DIRECT	Writes only to disk from memory, instead of also to buffer, etc
innodb_log_file_size	256M	Good Balance value
innodb_thread_concurrency	8	This should already be the default
innodb_log_buffer_size	4M	
		
key buffer (MyISAM)	Lower this	Lower this once I change all tables to Innodb

-->
--}}
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">

			<h3>Github ...</h3>
			<iframe src="http://ghbtns.com/github-btn.html?user=tomboruta&repo=serverconfig&type=watch&count=true&size=large" height="30" width="170" frameborder="0" scrolling="0" style="width:170px; height: 30px;" allowTransparency="true"></iframe>
			<iframe src="http://ghbtns.com/github-btn.html?user=tomboruta&repo=serverconfig&type=fork&count=true&size=large" height="30" width="170" frameborder="0" scrolling="0" style="width:170px; height: 30px;" allowTransparency="true"></iframe>
			<p><a href="https://github.com/tomboruta/serverconfig">Server Config on Github</a>. Issues and Pull Request are always welcome.</p>

			<h3>Subscribe to r/serverconfig</h3>
			<p>Use <a href="http://www.reddit.com/r/serverconfig/">r/serverconfig</a> to get ServerConfig.io updates and discuss web servers in general.</p>
		</div>
	</div>

@stop
