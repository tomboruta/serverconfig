/**
ServerConfig.org
Author: Tom Boruta
http://tomboruta.com
**/
selectedTechnologies = [];
technologyTemplates = [];
serverConfig = [];

function setDefaultTechnologies(){
	selectedTechnologies = {
		"webServer":"apache2",
		"dataStore":"innodb",
		"memory":"1GB",
		"digitalOceanPrice":10,
		"linodePrice":10
	};
}

function setTechnologyTemplates(){
	technologyTemplates = {
		"apache2Template" : {
				"displayTitle" : "Apache",
				"configFileLocation" : "/etc/apache2/apache2.conf",
				"beforeSettings" : "...<br>&lt;IfModule mpm_prefork_module&gt;",
				"afterSettings" : "&lt;/IfModule&gt;<br>..."
			},
		"nginxTemplate" : {
				"displayTitle" : "Nginx",
				"configFileLocation" : "",
				"beforeSettings" : "...",
				"afterSettings" : "..."
			},
		"innodbTemplate" : {
				"displayTitle" : "MySQL (innodb)",
				"configFileLocation" : "/etc/mysql/my.cnf",
				"beforeSettings" : "[mysqld]<br>...",
				"afterSettings" : "..."
			},
		"myisamTemplate" : {
				"displayTitle" : "MySQL (myisam)",
				"configFileLocation" : "/etc/mysql/my.cnf",
				"beforeSettings" : "[mysqld]<br>...",
				"afterSettings" : "..."
			}
	};
}

function setDefaultValues(){
	serverConfig = {
		"memoryButtons" : [
			{
				"buttonText":"512MB",
				"memory":"512MB",
				"multiplier":0.5,
				"cores":1,
				"digitalOceanPrice":5,
				"linodePrice":"N/A"
			},
			{
				"buttonText":"1GB",
				"memory":"1GB",
				"multiplier":1,
				"cores":1,
				"digitalOceanPrice":10,
				"linodePrice":10
			},
			{
				"buttonText":"2GB",
				"memory":"2GB",
				"multiplier":2,
				"cores":2,
				"digitalOceanPrice":20,
				"linodePrice":20
			},
			{
				"buttonText":"4GB",
				"memory":"4GB",
				"multiplier":4,
				"cores":2,
				"digitalOceanPrice":40,
				"linodePrice":40
			},
			{
				"buttonText":"8GB",
				"memory":"8GB",
				"multiplier":8,
				"cores":4,
				"digitalOceanPrice":80,
				"linodePrice":80
			},
			{
				"buttonText":"16GB",
				"memory":"16GB",
				"multiplier":16,
				"cores":8,
				"digitalOceanPrice":160,
				"linodePrice":160
			},
			{
				"buttonText":"32GB",
				"memory":"32GB",
				"multiplier":32,
				"cores":12,
				"digitalOceanPrice":320,
				"linodePrice":320
			},
			{
				"buttonText":"48GB",
				"memory":"48GB",
				"multiplier":48,
				"cores":16,
				"digitalOceanPrice":480,
				"linodePrice":480
			},
			{
				"buttonText":"64GB",
				"memory":"64GB",
				"multiplier":64,
				"cores":20,
				"digitalOceanPrice":640,
				"linodePrice":640
			},
			{
				"buttonText":"96GB",
				"memory":"96GB",
				"multiplier":96,
				"cores":20,
				"digitalOceanPrice":"N/A",
				"linodePrice":960
			}
		],
		"osButtons" : [
			{
				"buttonText":"Ubuntu",
				"defaultSelected":true
			}
		],
		"webServerButtons" : [
			{
				"buttonText":"Apache",
				"name":"apache2",
				"defaultSelected":true
			},
			{
				"buttonText":"Nginx",
				"name":"nginx",
				"defaultSelected":false
			}
		],
		"dataStoreButtons" : [
			{
				"buttonText":"MySQL (innodb)",
				"name":"innodb",
				"defaultSelected":true
			},
			{
				"buttonText":"MySQL (myisam)",
				"name":"myisam",
				"defaultSelected":false
			}
		],
		"apache2Settings" : [
			{
				"field":"StartServers",
				"labelHelpBlock":"",
				"val":2,
				"fieldValueSeparator":" ",
				"fieldValueEnder":"",
				"multiplierModifier":1,
				"popupDescription":"Number of child server processes created at startup.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/mpm_common.html#startservers"
			},
			{
				"field":"MinSpareServers",
				"labelHelpBlock":"",
				"val":6,
				"fieldValueSeparator":" ",
				"fieldValueEnder":"",
				"multiplierModifier":1,
				"popupDescription":"Minimum number of idle child server processes.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/prefork.html#minspareservers"
			},
			{
				"field":"MaxSpareServers",
				"labelHelpBlock":"",
				"val":12,
				"fieldValueSeparator":" ",
				"fieldValueEnder":"",
				"multiplierModifier":1,
				"popupDescription":"Maximum number of idle child server processes.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/prefork.html#maxspareservers"
			},
			{
				"field":"MaxClients",
				"labelHelpBlock":"",
				"val":40,
				"fieldValueSeparator":" ",
				"fieldValueEnder":"",
				"multiplierModifier":1,
				"popupDescription":"Maximum number of connections that will be processed simultaneously.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/mpm_common.html#maxclients"
			},
			{
				"field":"MaxRequestsPerChild",
				"labelHelpBlock":"",
				"val":300,
				"fieldValueSeparator":" ",
				"fieldValueEnder":"",
				"multiplierModifier":false,
				"popupDescription":"Limit on the number of requests that an individual child server will handle during its life.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/mpm_common.html#maxrequestsperchild"
			}
		],
		"nginxSettings" : [
			{
				"field":"worker_processes",
				"labelHelpBlock":"Run this command to get the optimal value:<br><code>grep processor /proc/cpuinfo | wc -l</code>",
				"val":1,
				"fieldValueSeparator":" ",
				"fieldValueEnder":";",
				"multiplierModifier":"cores",
				"popupDescription":"Defines the number of worker processes.",
				"referenceUrl":"http://nginx.org/en/docs/ngx_core_module.html#worker_processes"
			},
			{
				"field":"worker_connections",
				"labelHelpBlock":"Run this command to get the optimal value:<br><code>ulimit -n</code>",
				"val":1024,
				"fieldValueSeparator":" ",
				"fieldValueEnder":";",
				"multiplierModifier":false,
				"popupDescription":"Sets the maximum number of simultaneous connections that can be opened by a worker process.",
				"referenceUrl":"http://nginx.org/en/docs/ngx_core_module.html#worker_connections"
			}
		],
		"myisamSettings" : [
			{
				"field":"max_connections",
				"labelHelpBlock":"",
				"val":30,
				"fieldValueSeparator":" = ",
				"fieldValueEnder":"",
				"multiplierModifier":1,
				"popupDescription":"The maximum permitted number of simultaneous client connections.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_max_connections"
			},
			{
				"field":"key_buffer_size",
				"labelHelpBlock":"",
				"val":32000000,
				"fieldValueSeparator":" = ",
				"fieldValueEnder":"",
				"multiplierModifier":1,
				"popupDescription":"Index blocks for MyISAM tables are buffered and are shared by all threads. key_buffer_size is the size of the buffer used for index blocks.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_key_buffer_size"
			},
			{
				"field":"max_allowed_packet",
				"labelHelpBlock":"",
				"val":1000000,
				"fieldValueSeparator":" = ",
				"fieldValueEnder":"",
				"multiplierModifier":0,
				"popupDescription":"The maximum size of one packet or any generated/intermediate string.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_max_allowed_packet"
			},
			{
				"field":"thread_stack",
				"labelHelpBlock":"",
				"val":128000,
				"fieldValueSeparator":" = ",
				"fieldValueEnder":"",
				"multiplierModifier":0,
				"popupDescription":"The stack size for each thread.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_thread_stack"
			},
			{
				"field":"table_open_cache",
				"labelHelpBlock":"",
				"val":32,
				"fieldValueSeparator":" = ",
				"fieldValueEnder":"",
				"multiplierModifier":1,
				"popupDescription":"The number of open tables for all threads.",
				"referenceUrl":"https://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_table_open_cache"
			}
		],
		"innodbSettings" : [
			{
				"field":"max_connections",
				"labelHelpBlock":"",
				"val":30,
				"fieldValueSeparator":" = ",
				"fieldValueEnder":"",
				"multiplierModifier":1,
				"popupDescription":"The maximum permitted number of simultaneous client connections.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_max_connections"
			},
			{
				"field":"innodb_buffer_pool_size",
				"labelHelpBlock":"Optional optimization: Set this to 10% larger than the size of your database.",
				"val":256000000,
				"fieldValueSeparator":" = ",
				"fieldValueEnder":"",
				"multiplierModifier":1,
				"popupDescription":"The size in bytes of the buffer pool, the memory area where InnoDB caches table and index data.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/innodb-parameters.html#sysvar_innodb_buffer_pool_size"
			}
		]
	};
}

function displayAllButtons(){
	displayMemoryButtons();
	displaywebServerButtons();
	displayDataStoreButtons();
}

function displayMemoryButtons(){
	var htmloutput='<div class="btn-group">';
	$.each(serverConfig.memoryButtons, function(i, item){
		htmloutput +='<button type="button" class="btn btn-default" style="width:50%;" data-multiplier="'+item.multiplier+'" data-cores="'+item.cores+'" data-memory="'+item.memory+'" data-digitalOceanPrice="'+item.digitalOceanPrice+'" data-linodePrice="'+item.linodePrice+'">'+item.buttonText+'</button>';
	});
	htmloutput+='</div>';
	$('#memoryButtons').html(htmloutput);
	$('button[data-multiplier=1]').addClass('active');
}

function displayOsButtons(){
	// unused
	var htmloutput='';
	$.each(serverConfig.osButtons, function(i, item){
		htmloutput +='<button type="button" class="btn btn-default" data-defaultSelected="'+item.defaultSelected+'">'+item.buttonText+'</button> ';
	});
	$('#osButtons').html(htmloutput);
	$('button[data-defaultSelected=true]').addClass('active');
}

function displaywebServerButtons(){
	var htmloutput='<div class="btn-group">';
	$.each(serverConfig.webServerButtons, function(i, item){
		htmloutput +='<button type="button" class="btn btn-default" data-defaultSelected="'+item.defaultSelected+'" data-name="'+item.name+'">'+item.buttonText+'</button> ';
	});
	htmloutput+='</div>';
	$('#webServerButtons').html(htmloutput);
	$('button[data-defaultSelected=true]').addClass('active');
}

function displayDataStoreButtons(){
	var htmloutput='<div class="btn-group">';
	$.each(serverConfig.dataStoreButtons, function(i, item){
		htmloutput +='<button type="button" class="btn btn-default" data-defaultSelected="'+item.defaultSelected+'" data-name="'+item.name+'">'+item.buttonText+'</button> ';
	});
	htmloutput+='</div>';
	$('#dataStoreButtons').html(htmloutput);
	$('button[data-defaultSelected=true]').addClass('active');
}

function displayAllInputs(){
	displayInputs(eval("serverConfig."+selectedTechnologies.webServer+"Settings"),'webServerInputs');
	displayInputs(eval("serverConfig."+selectedTechnologies.dataStore+"Settings"),'dataStoreInputs');
}

function displayInputs(settings,spanId){
	var htmloutput='';
	$.each(settings, function(i, item){
		htmloutput += '<div class="form-group"><label for="'+item.field+'" class="col-md-8 control-label" data-toggle="popover" data-title="'+item.popupDescription+'" data-content="<a href=\''+item.referenceUrl+'\'>Reference</a>" data-html="true" data-placement="top">'+item.field+' <span class="glyphicon glyphicon-question-sign"></span><p class="help-block">'+item.labelHelpBlock+'</p></label><div class="col-md-4"><input type="text" class="form-control" id="'+item.field+'" value="-" readonly></div></div>';
	});
	$('#'+spanId).html(htmloutput);
}

function abbrNum(number, decPlaces) {
    decPlaces = Math.pow(10,decPlaces);
    var abbrev = [ "K", "M", "G", "T" ];
    for (var i=abbrev.length-1; i>=0; i--) {
        var size = Math.pow(10,(i+1)*3);
        if(size <= number) {
             number = Math.round(number*decPlaces/size)/decPlaces;
             if((number == 1000) && (i < abbrev.length - 1)) {
                 number = 1;
                 i++;
             }
             number += abbrev[i];
             break;
        }
    }
    return number;
}

function shortenNumbers(){
	$('input').each(function(i,item){
		if ($(item).val()>9999){
			$(item).val(abbrNum($(item).val(), 0));
		}
	});
}

function redisplayInputValues(settings){
	$.each(settings, function(i, item){
		$('#'+item.field).val(item.val);
	});
}

function redisplaySettings(settings,divId){
	$('.serverOptionsMemory').html(selectedTechnologies.memory);
	$('#digitalOceanPrice').html(selectedTechnologies.digitalOceanPrice);
	$('#linodePrice').html(selectedTechnologies.linodePrice);

	if (divId=="webServerSettings"){
		$('#'+divId+'_before').html(eval("technologyTemplates."+selectedTechnologies.webServer+"Template.beforeSettings"));
		$('#'+divId+'_after').html(eval("technologyTemplates."+selectedTechnologies.webServer+"Template.afterSettings"));
	}
	else if (divId=="dataStoreSettings"){
		$('#'+divId+'_before').html(eval("technologyTemplates."+selectedTechnologies.dataStore+"Template.beforeSettings"));
		$('#'+divId+'_after').html(eval("technologyTemplates."+selectedTechnologies.dataStore+"Template.afterSettings"));
	}
	$('#'+divId).html(function(){
		htmloutput='';
		$.each(settings, function(i, item){
			htmloutput += item.field + item.fieldValueSeparator;
			htmloutput += $('#'+item.field).val() + item.fieldValueEnder + '<br>';
		});
		return htmloutput;
	});
}

function redisplayNumbers(){
	$('.datastoreTitle').html(eval("technologyTemplates."+selectedTechnologies.dataStore+"Template.displayTitle"));
	$('.datastoreConfigLocation').html(eval("technologyTemplates."+selectedTechnologies.dataStore+"Template.configFileLocation"));
	$('.webServerTitle').html(eval("technologyTemplates."+selectedTechnologies.webServer+"Template.displayTitle"));
	$('.webServerConfigLocation').html(eval("technologyTemplates."+selectedTechnologies.webServer+"Template.configFileLocation"));

	redisplayInputValues(eval("serverConfig."+selectedTechnologies.webServer+"Settings"));
	redisplayInputValues(eval("serverConfig."+selectedTechnologies.dataStore+"Settings"));

	shortenNumbers();

	redisplaySettings(eval("serverConfig."+selectedTechnologies.webServer+"Settings"),"webServerSettings");
	redisplaySettings(eval("serverConfig."+selectedTechnologies.dataStore+"Settings"),"dataStoreSettings");

	$('[data-toggle="popover"]').clickover();
}

function recalculateNumbers(multiplier,cores){
	setDefaultValues();

	$.each(serverConfig.apache2Settings, function(i, item){
		if (item.multiplierModifier){
			item.val=item.val*(multiplier*item.multiplierModifier);
		}
	});
	$.each(serverConfig.nginxSettings, function(i, item){
		if (item.multiplierModifier=="cores"){
			item.val=cores;
		}
	});
	$.each(serverConfig.myisamSettings, function(i, item){
		if (item.multiplierModifier){
			item.val=item.val*(multiplier*item.multiplierModifier);
		}
	});
	$.each(serverConfig.innodbSettings, function(i, item){
		if (item.multiplierModifier){
			item.val=item.val*(multiplier*item.multiplierModifier);
		}
	});
	redisplayNumbers();
}

$(document).ready(function() {

	setDefaultTechnologies();
	setTechnologyTemplates();
	setDefaultValues();

	displayAllButtons();
	displayAllInputs();

	redisplayNumbers();

	$('[data-toggle="popover"]').clickover();

	// selecting a memory size
	$('.server-selection button').on('click',function(){
		if (!$(this).hasClass('active')){
			selectedTechnologies.memory=$(this).data('memory');
			selectedTechnologies.digitalOceanPrice=$(this).data('digitaloceanprice');
			selectedTechnologies.linodePrice=$(this).data('linodeprice');
			recalculateNumbers($(this).data('multiplier'),$(this).data('cores'));
		}
		$(this).addClass('active');
		$(this).parent().children('.server-selection button').not(this).removeClass('active');
		$('.displayServerSize').html($(this).html());
	});
	// selecting an OS
	$('.os-selection button').on('click',function(){
		$(this).addClass('active');
		$(this).parent().children('.os-selection button').not(this).removeClass('active');
		$('.displayOS').html($(this).html());
	});
	// selecting a webServer
	$('.webServer-selection button').on('click',function(){
		if (!$(this).hasClass('active')){
			selectedTechnologies.webServer=$(this).data('name');
			displayAllInputs();
			redisplayNumbers();
		}
		$(this).addClass('active');
		$(this).parent().children('.webServer-selection button').not(this).removeClass('active');
	});
	// selecting a data store
	$('.dataStore-selection button').on('click',function(){
		if (!$(this).hasClass('active')){
			selectedTechnologies.dataStore=$(this).data('name');
			displayAllInputs();
			redisplayNumbers();
		}
		$(this).addClass('active');
		$(this).parent().children('.dataStore-selection button').not(this).removeClass('active');
	});

});
