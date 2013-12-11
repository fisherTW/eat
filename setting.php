<?
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
	$jobj[1]->active = 1;
	$footerNav = getFooterNav($jobj);
	
	for($i=0; $i < count($_SESSION['myFood']); $i++) {
		$list_food .= getli($_SESSION['myFood'][$i]);
	}
	
	$str = "
<!DOCTYPE html>
<html>
<head>
<title>eat</title>
	<link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css' />
	<link rel='stylesheet' href='css/animate.min.css' />
	<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
	<script src='http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js'></script>
	<script src='js/setting.js'></script>
  	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'> 
</head>

<body>
	<div class='ui-body-b ui-body'>
	<div id='div_show'>
	<input type='text' id='txt_add' data-clear-btn='true' name='text-19' id='text-19' value='Value' data-inline='true'>
	<a href='#' fType='add' data-role='button' data-icon='plus' data-iconpos='notext' data-inline='true'></a>

	<ul id='ul_list' data-role='listview' data-split-icon='minus' data-theme='c' data-split-theme='b' data-inset='true'>
	$list_food</ul>
	</div>
	$footerNav
	</div>
</body></html>";
	echo $str;
}

function ajaxHandle($req) {
	switch($req) {
		case 'onclkDel':
			$key = array_search($_POST['fVal'],$_SESSION['myFood']);
			$_SESSION['myFood'] = array_splice($_SESSION['myFood'],$key,1);
			return $_POST['fVal'];
			break;
		case 'onclkAdd':
			array_push($_SESSION['myFood'],$_POST['txt_add']);
			return getli($_POST['txt_add']);
			break;
	}
}

function getli($val) {
	$ret = "<li fVal='$val'><a href='#'>
			<h2>$val</h2>
			</a><a href='#' fType='del' fVal='$val'>刪這筆</a>
		</li>";
		
	return $ret;
}
?>