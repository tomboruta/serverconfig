/**
ServerConfig.io
Author: Tom Boruta
http://tomboruta.com
**/
serverConfig = [];

function setDefaults(){
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
		"apache2Settings" : [
			{
				"field":"StartServers",
				"val":2,
				"fieldValueSeparator":' ',
				"multiplierModifier":1
			},
			{
				"field":"MinSpareServers",
				"val":6,
				"fieldValueSeparator":' ',
				"multiplierModifier":1
			},
			{
				"field":"MaxSpareServers",
				"val":12,
				"fieldValueSeparator":' ',
				"multiplierModifier":1
			},
			{
				"field":"MaxClients",
				"val":40,
				"fieldValueSeparator":' ',
				"multiplierModifier":1
			},
			{
				"field":"MaxRequestsPerChild",
				"val":300,
				"fieldValueSeparator":' ',
				"multiplierModifier":false
			}
		],
		"phpSettings" : [
			{
				"field":"max_execution_time",
				"val":30,
				"fieldValueSeparator":' = ',
				"multiplierModifier":false
			},
			{
				"field":"memory_limit",
				"val":128000000,
				"fieldValueSeparator":' = ',
				"multiplierModifier":false
			}
		],
		"myisamSettings" : [
			{
				"field":"max_connections",
				"val":80,
				"fieldValueSeparator":' = ',
				"multiplierModifier":1
			},
			{
				"field":"key_buffer",
				"val":32000000,
				"fieldValueSeparator":' = ',
				"multiplierModifier":1
			},
			{
				"field":"max_allowed_packet",
				"val":1000000,
				"fieldValueSeparator":' = ',
				"multiplierModifier":1
			},
			{
				"field":"thread_stack",
				"val":128000,
				"fieldValueSeparator":' = ',
				"multiplierModifier":1
			},
			{
				"field":"table_cache",
				"val":32,
				"fieldValueSeparator":' = ',
				"multiplierModifier":1
			}
		]
	};
}

function displayMemoryButtons(){
	var htmloutput='';
	$.each(serverConfig.memoryButtons, function(i, item){
		htmloutput +='<button type="button" class="btn btn-lg btn-default" data-multiplier="'+item.multiplier+'">'+item.buttonText+'</button> ';
	});
	$('#memoryButtons').html(htmloutput);
	$('button[data-multiplier=1]').addClass('active');
}

function displayInputs(settings,spanId){
	var htmloutput='';
	$.each(settings, function(i, item){
		htmloutput += '<div class="form-group"><label for="'+item.field+'" class="col-md-7 control-label">'+item.field+'</label><div class="col-md-5"><input type="text" class="form-control" id="'+item.field+'" value="-" readonly></div></div>';
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
	redisplayInputValues(serverConfig.apache2Settings);
	redisplayInputValues(serverConfig.phpSettings);
	redisplayInputValues(serverConfig.myisamSettings);

	shortenNumbers();

	redisplaySettings(serverConfig.apache2Settings,'apache2Settings');
	redisplaySettings(serverConfig.phpSettings,'phpSettings');
	redisplaySettings(serverConfig.myisamSettings,'myisamSettings');
}

function recalculateNumbers(multiplier){
	setDefaults();
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
	redisplayNumbers();
}

$(document).ready(function() {

	setDefaults();

	displayMemoryButtons();
	displayInputs(serverConfig.apache2Settings,'apache2Inputs');
	displayInputs(serverConfig.phpSettings,'phpInputs');
	displayInputs(serverConfig.myisamSettings,'myisamInputs');

	redisplayNumbers();

	// selecting a memory size
	$('.server-selection button').on('click',function(){
		if (!$(this).hasClass('active')){
			recalculateNumbers($(this).data('multiplier'));
		}
		$(this).addClass('active');
		$(this).parent().children('.server-selection button').not(this).removeClass('active');
		$('.displayServerSize').html($(this).html());
	});
	$('.os-selection button').on('click',function(){
		$(this).addClass('active');
		$(this).parent().children('.os-selection button').not(this).removeClass('active');
		$('.displayOS').html($(this).html());
	});
});
