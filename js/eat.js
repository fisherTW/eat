var countRound = 0;
var ERROR_EMPTY_SESSION = -1001;

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
	
	var ary_tmp = data.split('][');
	var data = ary_tmp[0];
	var msg = ary_tmp[1];
	
	if(parseInt(data) < 0) {
		switch(parseInt(data)) {
			case ERROR_EMPTY_SESSION:
				$('#div_show').html(msg).show();break;
		}
		
		$('#div_btn').show();
		return;
	}

	$('#div_show').html(data).show();

	if(countRound < parseInt($('#hidden_count').val())) {
		$('#div_show').removeClass().addClass('flipInX animated');
		window.setTimeout( function(){
			$('#div_show').removeClass();
			onclkGo();
		}, 500);
	} else {
		$('#div_show').removeClass().addClass('tada animated');
		window.setTimeout( function(){
			$('#div_show').removeClass();
			$('#btn_go').val('再一次').button('refresh');
			$('#btn_go').buttonMarkup({ icon: "refresh" });
			$('#div_btn').show();
		}, 1500);
		countRound = 0;	// reset counter
	}
	
}