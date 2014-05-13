/**
ServerConfig.io
Author: Tom Boruta
http://tomboruta.com
**/
selectedTechnologies = [];
technologyTemplates = [];
serverConfig = [];

function setDefaultTechnologies(){
	selectedTechnologies = {
		"webserver":"apache2",
		"serverSideLanguage":"php",
		"dataStore":"innodb"
	};
}

function setTechnologyTemplates(){
	technologyTemplates = {
		"apache2Template" : {
				"displayTitle" : "Apache"
			},
		"phpTemplate" : {
				"displayTitle" : "PHP"
			},
		"innodbTemplate" : {
				"displayTitle" : "MySQL (innodb)"
			},
		"myisamTemplate" : {
				"displayTitle" : "MySQL (myisam)"
			}
	};
}

function setDefaultValues(){
	serverConfig = {
		"memoryButtons" : [
			{
				"buttonText":"512MB",
				"multiplier":0.5
			},
			{
				"_comment":"This is the default server size.",
				"buttonText":"1GB",
				"multiplier":1
			},
			{
				"buttonText":"2GB",
				"multiplier":2
			},
			{
				"buttonText":"4GB",
				"multiplier":4
			},
			{
				"buttonText":"8GB",
				"multiplier":8
			}
		],
		"osButtons" : [
			{
				"buttonText":"Ubuntu",
				"defaultSelected":true
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
				"multiplierModifier":1,
				"popupDescription":"Number of child server processes created at startup.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/mpm_common.html#startservers"
			},
			{
				"field":"MinSpareServers",
				"labelHelpBlock":"",
				"val":6,
				"fieldValueSeparator":" ",
				"multiplierModifier":1,
				"popupDescription":"Minimum number of idle child server processes.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/prefork.html#minspareservers"
			},
			{
				"field":"MaxSpareServers",
				"labelHelpBlock":"",
				"val":12,
				"fieldValueSeparator":" ",
				"multiplierModifier":1,
				"popupDescription":"Maximum number of idle child server processes.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/prefork.html#maxspareservers"
			},
			{
				"field":"MaxClients",
				"labelHelpBlock":"",
				"val":40,
				"fieldValueSeparator":" ",
				"multiplierModifier":1,
				"popupDescription":"Maximum number of connections that will be processed simultaneously.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/mpm_common.html#maxclients"
			},
			{
				"field":"MaxRequestsPerChild",
				"labelHelpBlock":"",
				"val":300,
				"fieldValueSeparator":" ",
				"multiplierModifier":false,
				"popupDescription":"Limit on the number of requests that an individual child server will handle during its life.",
				"referenceUrl":"http://httpd.apache.org/docs/2.2/mod/mpm_common.html#maxrequestsperchild"
			}
		],
		"phpSettings" : [
			{
				"field":"max_execution_time",
				"labelHelpBlock":"",
				"val":30,
				"fieldValueSeparator":" = ",
				"multiplierModifier":false,
				"popupDescription":"This sets the maximum time in seconds a script is allowed to run before it is terminated by the parser.",
				"referenceUrl":"http://us1.php.net/manual/en/info.configuration.php#ini.max-execution-time"
			},
			{
				"field":"memory_limit",
				"labelHelpBlock":"",
				"val":128000000,
				"fieldValueSeparator":" = ",
				"multiplierModifier":false,
				"popupDescription":"This sets the maximum amount of memory in bytes that a script is allowed to allocate. ",
				"referenceUrl":"http://www.php.net/manual/en/ini.core.php#ini.memory-limit"
			}
		],
		"myisamSettings" : [
			{
				"field":"max_connections",
				"labelHelpBlock":"",
				"val":30,
				"fieldValueSeparator":" = ",
				"multiplierModifier":1,
				"popupDescription":"The maximum permitted number of simultaneous client connections.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_max_connections"
			},
			{
				"field":"key_buffer_size",
				"labelHelpBlock":"",
				"val":32000000,
				"fieldValueSeparator":" = ",
				"multiplierModifier":1,
				"popupDescription":"Index blocks for MyISAM tables are buffered and are shared by all threads. key_buffer_size is the size of the buffer used for index blocks.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_key_buffer_size"
			},
			{
				"field":"max_allowed_packet",
				"labelHelpBlock":"",
				"val":1000000,
				"fieldValueSeparator":" = ",
				"multiplierModifier":0,
				"popupDescription":"The maximum size of one packet or any generated/intermediate string.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_max_allowed_packet"
			},
			{
				"field":"thread_stack",
				"labelHelpBlock":"",
				"val":128000,
				"fieldValueSeparator":" = ",
				"multiplierModifier":0,
				"popupDescription":"The stack size for each thread.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_thread_stack"
			},
			{
				"field":"table_open_cache",
				"labelHelpBlock":"",
				"val":32,
				"fieldValueSeparator":" = ",
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
				"multiplierModifier":1,
				"popupDescription":"The maximum permitted number of simultaneous client connections.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/server-system-variables.html#sysvar_max_connections"
			},
			{
				"field":"innodb_buffer_pool_size",
				"labelHelpBlock":"Optional optimization: Set this to 10% larger than the size of your database.",
				"val":256000000,
				"fieldValueSeparator":" = ",
				"multiplierModifier":1,
				"popupDescription":"The size in bytes of the buffer pool, the memory area where InnoDB caches table and index data.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/innodb-parameters.html#sysvar_innodb_buffer_pool_size"
			},
			{
				"field":"innodb_log_file_size",
				"labelHelpBlock":"",
				"val":64000000,
				"fieldValueSeparator":" = ",
				"multiplierModifier":1,
				"popupDescription":"The size in bytes of each log file in a log group.",
				"referenceUrl":"http://dev.mysql.com/doc/refman/5.5/en/innodb-parameters.html#sysvar_innodb_log_file_size"
			}
		]
	};
}

function displayAllButtons(){
	displayMemoryButtons();
	displayOsButtons();
	displayDataStoreButtons();
}

function displayMemoryButtons(){
	var htmloutput='';
	$.each(serverConfig.memoryButtons, function(i, item){
		htmloutput +='<button type="button" class="btn btn-default" data-multiplier="'+item.multiplier+'">'+item.buttonText+'</button> ';
	});
	$('#memoryButtons').html(htmloutput);
	$('button[data-multiplier=1]').addClass('active');
}

function displayOsButtons(){
	var htmloutput='';
	$.each(serverConfig.osButtons, function(i, item){
		htmloutput +='<button type="button" class="btn btn-default" data-defaultSelected="'+item.defaultSelected+'">'+item.buttonText+'</button> ';
	});
	$('#osButtons').html(htmloutput);
	$('button[data-defaultSelected=true]').addClass('active');
}

function displayDataStoreButtons(){
	var htmloutput='';
	$.each(serverConfig.dataStoreButtons, function(i, item){
		htmloutput +='<button type="button" class="btn btn-default" data-defaultSelected="'+item.defaultSelected+'" data-name="'+item.name+'">'+item.buttonText+'</button> ';
	});
	$('#dataStoreButtons').html(htmloutput);
	$('button[data-defaultSelected=true]').addClass('active');
}

function displayAllInputs(){
	displayInputs(serverConfig.apache2Settings,'apache2Inputs');
	displayInputs(serverConfig.phpSettings,'phpInputs');
	displayInputs(eval("serverConfig."+selectedTechnologies.dataStore+"Settings"),'dataStoreInputs');
}

function displayInputs(settings,spanId){
	var htmloutput='';
	$.each(settings, function(i, item){
		htmloutput += '<div class="form-group"><label for="'+item.field+'" class="col-md-7 control-label hasPopup" data-title="'+item.popupDescription+'" data-content="<a href=\''+item.referenceUrl+'\'>Reference</a>" data-html="true" data-placement="top">'+item.field+' <span class="glyphicon glyphicon-question-sign"></span><p class="help-block">'+item.labelHelpBlock+'</p></label><div class="col-md-5"><input type="text" class="form-control" id="'+item.field+'" value="-" readonly></div></div>';
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
	$('#'+divId).html(function(){
		htmloutput='';
		$.each(settings, function(i, item){
			htmloutput += item.field + item.fieldValueSeparator;
			htmloutput += $('#'+item.field).val() + '<br>';
		});
		return htmloutput;
	});
}

function redisplayNumbers(){
	$('.datastoreTitle').html(eval("technologyTemplates."+selectedTechnologies.dataStore+"Template.displayTitle"));

	redisplayInputValues(eval("serverConfig."+selectedTechnologies.webserver+"Settings"));
	redisplayInputValues(eval("serverConfig."+selectedTechnologies.serverSideLanguage+"Settings"));
	redisplayInputValues(eval("serverConfig."+selectedTechnologies.dataStore+"Settings"));

	shortenNumbers();

	redisplaySettings(eval("serverConfig."+selectedTechnologies.webserver+"Settings"),"webserverSettings");
	redisplaySettings(eval("serverConfig."+selectedTechnologies.serverSideLanguage+"Settings"),"serverSideLanguageSettings");
	redisplaySettings(eval("serverConfig."+selectedTechnologies.dataStore+"Settings"),"dataStoreSettings");

	$('label.hasPopup').popover();
}

function recalculateNumbers(multiplier){
	setDefaultValues();

	$.each(serverConfig.apache2Settings, function(i, item){
		if (item.multiplierModifier){
			item.val=item.val*(multiplier*item.multiplierModifier);
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

	$('label.hasPopup').popover();

	// selecting a memory size
	$('.server-selection button').on('click',function(){
		if (!$(this).hasClass('active')){
			recalculateNumbers($(this).data('multiplier'));
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
