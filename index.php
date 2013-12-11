<?
session_start();
require_once("inc/lib.inc");

if($_POST['ajax'] == 1) {
	echo ajaxHandle($_POST['req']);
} else {
	main();
}

function main() {
	global $hidden_count;
	global $jobj_tag;
	
	$jobj = json_decode($jobj_tag);
	$jobj[0]->active = 1;
	$footerNav = getFooterNav($jobj);
	
	$str = "
<!DOCTYPE html>
<html>
<head>
<title>eat</title>
	<link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css' />
	<link rel='stylesheet' href='css/animate.min.css' />
	<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
	<script src='http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js'></script>
	<script src='js/eat.js'></script>
	<script src='js/setting.js'></script>
  	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'> 
</head>

<body>
	<div class='ui-body-b ui-body'>
	<input type='hidden' id='hidden_count' value='$hidden_count'>
	<div id='div_show' style='height:200px;display:none;text-align:center;font-size:48pt;line-height:200px'></div>
	<div id='div_btn' style='text-align:center'><input type='button' id='btn_go' data-icon='check' data-iconpos='top' value='吃什麼' data-inline='true' onclick='onclkGo();'></div>
	$footerNav
	</div>
</body></html>";
	echo $str;
}

function ajaxHandle($req) {
	switch($req) {
		case 'rand':
			return $_SESSION['myfood'][rand(0,(count($ary_food)-1))];
			break;
	}
}

?>