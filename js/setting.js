function onclkDel(obj) {
	var request_url = "index.php";
	var odata = {ajax:1,req:'onclkDel',fVal:obj.attr('fVal'),callback:'process_onclkDel'};
	
	$.ajax({
		type: "POST",
		url: request_url,
		cache: false,
		async : false,
		data: odata,
		error: function(xhr){
			alert("[xxx] xmlHttp Failure!!");
		},
		success: process_onclkDel
	});	
}

function onclkAdd(obj) {
	var request_url = "index.php";
	var odata = {ajax:1,req:'onclkAdd',txt_add:$('#txt_add').val(),callback:'process_onclkDel'};
	
	$.ajax({
		type: "POST",
		url: request_url,
		cache: false,
		async : false,
		data: odata,
		error: function(xhr){
			alert("[xxx] xmlHttp Failure!!");
		},
		success: process_onclkAdd
	});	
}

function process_onclkDel(data) {
	$('li[fVal=' + data +']').remove();
}

function process_onclkAdd(data) {
	$(data).appendTo($('#ul_list'));
	$('#ul_list').listview().listview( "refresh" );
	$('#txt_add').val('');

	$('a[fType=del]').bind( "click", function() {
  		onclkDel($(this));
	});
}