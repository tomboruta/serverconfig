@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Server Config - A better starting point for your server
@stop

@section('meta')
@parent
<meta name="description" content="Get a better starting point for your server over the default settings.">
@stop

{{-- Content --}}
@section('content')

	<h2 class="page-header">
		Select Server Options
		<small>
			Get a better starting point for your server over the default settings.
		</small>
	</h2>
	<div class="row">
		<div class="col-md-4">
			<div class="box box-solid box-success">
				<div class="box-header">
					<i class="fa fa-tasks"></i>
					<h3 class="box-title">Memory</h3>
				</div>
				<div class="box-body server-selection">
					<span id="memoryButtons"></span>
				</div>
			</div><!-- /.box -->
		</div>
		<div class="col-md-4">
			<div class="box box-solid box-info">
				<div class="box-header">
					<i class="fa fa-laptop"></i>
					<h3 class="box-title">OS</h3>
				</div>
				<div class="box-body os-selection">
					<span id="osButtons"></span>
				</div>
			</div><!-- /.box -->
		</div>
		<div class="col-md-4">
			<div class="box box-solid box-danger">
				<div class="box-header">
					<i class="fa fa-download"></i>
					<h3 class="box-title">Data Store</h3>
				</div>
				<div class="box-body dataStore-selection">
					<span id="dataStoreButtons"></span>
				</div>
			</div><!-- /.box -->
		</div>
	</div>

	<h2 class="page-header">Initial Settings for a <span class="displayServerSize">1GB</span> Server running on <span class="displayOS">Ubuntu</span></h2>

	<div class="row">
		<div class="col-md-4">
			<div class="box box-warning">
				<div class="box-header">
					<i class="fa fa-certificate"></i>
					<h3 class="box-title">Apache</h3>
				</div>
				<div class="box-body">
					<form role="form">
						<span id="apache2Inputs"></span>
					</form>
					<div class="clearfix"></div>
				</div>
			</div><!-- /.box -->
		</div>
		<div class="col-md-4">
			<div class="box box-success">
				<div class="box-header">
					<i class="fa fa-gear"></i>
					<h3 class="box-title">PHP</h3>
				</div>
				<div class="box-body">
					<form role="form">
						<span id="phpInputs"></span>
					</form>
					<div class="clearfix"></div>
				</div>
			</div><!-- /.box -->
		</div>
		<div class="col-md-4">
			<div class="box box-danger">
				<div class="box-header">
					<i class="fa fa-download"></i>
					<h3 class="box-title datastoreTitle"></h3>
				</div>
				<div class="box-body">
					<form role="form">
						<span id="dataStoreInputs"></span>
					</form>
					<div class="clearfix"></div>
				</div>
			</div><!-- /.box -->
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="box box-solid">
				<div class="box-header">
				</div>
				<div class="box-body">
					<div class="alert alert-warning">
						<i class="fa fa-certificate"></i>
						Change these Apache settings<br>
						<em>/etc/apache2/apache2.conf</em>
					</div>
					...<br>
					&lt;IfModule mpm_prefork_module&gt;
					<div id="webserverSettings"></div>
					&lt;/IfModule&gt;<br>
					...
				</div>
			</div><!-- /.box -->
		</div>
		<div class="col-md-4">
			<div class="box box-solid">
				<div class="box-header">
				</div>
				<div class="box-body">
					<div class="alert alert-success">
						<i class="fa fa-gear"></i>
						Change these PHP settings<br>
						<em>/etc/php5/apache2/php.ini</em>
					</div>
					...
					<div id="serverSideLanguageSettings"></div>
					...
				</div>
			</div><!-- /.box -->
		</div>
		<div class="col-md-4">
			<div class="box box-solid">
				<div class="box-header">
				</div>
				<div class="box-body">
					<div class="alert alert-danger">
						<i class="fa fa-download"></i>
						Change these <span class="datastoreTitle"></span> settings<br>
						<em>/etc/mysql/my.cnf</em>
					</div>
					[mysqld]<br>
					...
					<div id="dataStoreSettings"></div>
					...
				</div>
			</div><!-- /.box -->
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">

			<h3><i class="fa fa-github"></i> Github</h3>
			<iframe src="http://ghbtns.com/github-btn.html?user=tomboruta&repo=serverconfig&type=watch&count=true&size=large" height="30" width="170" frameborder="0" scrolling="0" style="width:170px; height: 30px;" allowTransparency="true"></iframe>
			<iframe src="http://ghbtns.com/github-btn.html?user=tomboruta&repo=serverconfig&type=fork&count=true&size=large" height="30" width="170" frameborder="0" scrolling="0" style="width:170px; height: 30px;" allowTransparency="true"></iframe>
			<dl class="dl-horizontal">
                <dt><a href="https://github.com/tomboruta/serverconfig">Server Config repo</a></dt>
                <dd>Issues and Pull Request are always welcome.</dd>
            </dl>

			<h3><i class="fa fa-rss-square"></i> Subscribe to r/serverconfig</h3>
			<dl class="dl-horizontal">
                <dt><a href="http://www.reddit.com/r/serverconfig/">r/serverconfig</a></dt>
                <dd>Get ServerConfig.io updates and discuss web servers in general.</dd>
            </dl>

			<h3><i class="fa fa-thumbs-o-up"></i> Special Thanks</h3>
			<dl class="dl-horizontal">
                <dt><a href="http://www.almsaeedstudio.com/">Almsaeed Studio</a></dt>
                <dd>For the awesome <a href="https://github.com/almasaeed2010/AdminLTE">open source</a> AdminLTE website template.</dd>
            </dl>
		</div>
	</div>

@stop
