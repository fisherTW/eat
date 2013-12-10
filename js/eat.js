var countRound = 0;

function onclkGo() {
	var request_url = "index.php";
	var odata = {ajax:1,req:'rand',callback:'processData'};
	
	$('#div_btn').hide();
	
	$.ajax({
		type: "POST",
		url: request_url,
		cache: false,
		async : false,
		data: odata,
		error: function(xhr){
			alert("[xxx] xmlHttp Failure!!");
		},
		success: processData
	});	
}

function processData(data) {
	countRound++;
	$('#div_show').html('<h1>' + data + '</h1>').hide();
	if(countRound < parseInt($('#hidden_count').val())) {
		$('#div_show').slideDown('slow', function() {
			// Animation complete.
			onclkGo();
		});
	} else {
		$('#div_show').slideDown('slow');
		$('#btn_go').val('再一次').button('refresh');
		$('#btn_go').attr('data-icon','refresh').button('refresh');
		$('#div_btn').show();
		countRound = 0;	// reset counter
	}
	
}