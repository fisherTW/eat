<?
$hidden_count = 1;
$ary_food = array(
	1	=> '巧福',
	2	=> '賣當勞',
	3	=> '肯的雞',
	4	=> '李記蒸餃',
	5	=> '老向',
	6	=> '快炒',
	7	=> '燒臘',
	8	=> '藍天',
	9	=> '逢甲'
);

if($_POST['ajax'] == 1) {
	echo ajaxHandle($_POST['req']);
} else {
	main();
}

function main() {
	global $hidden_count;
	
	$str = "
<!DOCTYPE html>
<html>
<head>
<title>eat</title>
	<link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css' />
	<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
	<script src='http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js'></script>
	<script src='js/eat.js'></script>
  	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
</head>

<body>
	<input type='hidden' id='hidden_count' value='$hidden_count'>
	<div id='div_show' style='height:200px;display:none;background-color:yellow;text-align:center'></div>
	<div id='div_btn'><input type='button' id='btn_go' data-icon='check' data-iconpos='top' value='go' onclick='onclkGo();'></div>
</body></html>";
	echo $str;
}

function ajaxHandle($req) {
	global $ary_food;
	
	switch($req) {
		case 'rand':
			return $ary_food[rand(1,count($ary_food))];
			break;
	}
}

?>