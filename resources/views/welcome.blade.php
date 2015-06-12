@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h2 class="page-header">
                Select Server Options
                <small>
                    Get a better starting point for your server over the default settings.
                </small>
            </h2>
        </div>
        <div class="col-md-4">
            <p>
            <form action="#" method="post" id="emailsubscribe">
                <label for="email">Signup for Server Config updates</label><br>
                <input type="email" id="email" name="email" placeholder="Email Address">
                <button id="emailsubscribebutton" type="submit">Subscribe</button>
                <span id="emailsubscribeinidcator"></span>
                <div id="errormsg" class="text-red"></div>
            </form>
            </p>
        </div>
    </div>
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
            <div class="box box-solid box-warning">
                <div class="box-header">
                    <i class="fa fa-certificate"></i>
                    <h3 class="box-title">Web Server</h3>
                </div>
                <div class="box-body webServer-selection">
                    <span id="webServerButtons"></span>
                    <form role="form">
                        <span id="webServerInputs"></span>
                    </form>
                    <div class="clearfix"></div>
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
                    <form role="form">
                        <span id="dataStoreInputs"></span>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div><!-- /.box -->
        </div>
    </div>

    <h2 class="page-header">Initial Settings for a <span class="displayServerSize">1GB</span> Server</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Quick FAQs</h3>
                </div>
                <div class="box-body">
                    <dl>
                        <dt class="control-label" data-toggle="popover" data-title="Why shouldn't I just use the defaults?" data-content="The default settings do not take into account the amount of memory your system has, which is usually the most important factor in determing good numbers for these settings." data-html="true" data-placement="top">
                            Why shouldn't I just use the defaults?
                            <span class="glyphicon glyphicon-question-sign"></span>
                        </dt>
                        <dd>&nbsp;</dd>
                        <dt class="control-label" data-toggle="popover" data-title="Why no server-side language settings?" data-content="PHP, Python, Ruby, etc already have good default settings." data-html="true" data-placement="top">
                            Why no server-side language settings?
                            <span class="glyphicon glyphicon-question-sign"></span>
                        </dt>
                        <dd>&nbsp;</dd>
                        <dt class="control-label" data-toggle="popover" data-title="Why no CPU or hard drive options?" data-content="CPU speeds and hard drive sizes on most hosting providers are more than sufficient for most projects." data-html="true" data-placement="top">
                            Why no CPU or hard drive options?
                            <span class="glyphicon glyphicon-question-sign"></span>
                        </dt>
                        <dd>&nbsp;</dd>
                    </dl>
                </div>
            </div><!-- /.box -->
        </div>
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">
                        Change these <span class="webServerTitle"></span> settings 
                        <br> 
                        <small class="text-muted webServerConfigLocation"></small>
                    </h3>
                    
                </div>
                <div class="box-body">
                    <div id="webServerSettings_before"></div>
                    <div id="webServerSettings"></div>
                    <div id="webServerSettings_after"></div>
                </div>
            </div><!-- /.box -->
        </div>
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">
                        Change these <span class="datastoreTitle"></span> settings
                        <br>
                        <small class="datastoreConfigLocation"></small>
                    </h3>
                </div>
                <div class="box-body">
                    <div id="dataStoreSettings_before"></div>
                    <div id="dataStoreSettings"></div>
                    <div id="dataStoreSettings_after"></div>
                </div>
            </div><!-- /.box -->
        </div>
    </div>

    <h2 class="page-header">Suggested Server Options</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 class="serverOptionsMemory">
                        1GB 
                    </h3>
                    <p>
                        Digital Ocean<br>
                        <strong>Sign up for a $10 Free Credit</strong>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-cloud"></i>
                </div>
                <a class="small-box-footer" href="https://www.digitalocean.com/?refcode=90e1dbb028ee" target="_blank">
                    $<span id="digitalOceanPrice"></span>/month <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 class="serverOptionsMemory">
                        1GB 
                    </h3>
                    <p>
                        Linode<br>
                        &nbsp;
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-cloud"></i>
                </div>
                <a class="small-box-footer" href="https://www.linode.com/?r=6568c4f9d1ff6cb63355b12e676cda9d519ef85b" target="_blank">
                    $<span id="linodePrice"></span>/month <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <h4 class="page-header"></h4>

    <div class="row">
        <div class="col-xs-6 text-center">
            <a href="https://github.com/tomboruta/serverconfig">Github Repo</a>
        </div>
        <div class="col-xs-6 text-center">
            <a href="http://www.reddit.com/r/serverconfig/">Official Subreddit...</a>
        </div>
    </div>
    <br>

@endsection