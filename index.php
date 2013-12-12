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

	// index
	$jobj[0]->active = 1;
	$jobj[1]->active = 0;
	$footerNav_index = getFooterNav($jobj);
	
	// setting
	$jobj[0]->active = 0;
	$jobj[1]->active = 1;
	$footerNav_setting = getFooterNav($jobj);
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
	<link rel='stylesheet' href='css/eat.css' />
	<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
	<script src='http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js'></script>
	<script src='js/eat.js' type='text/javascript'></script>
	<script src='js/setting.js' type='text/javascript'></script>
  	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1,width=device-width, height=device-height,initial-scale=1.0, maximum-scale=1.0,user-scalable=no;'>
	
</head>

<body>
	<div id='div_indexPage' data-role='page'>
		<script type='text/javascript'>
		$( document ).delegate('#div_indexPage', 'pageinit', function() {
		});
		</script>
		<div data-role='header' data-position='fixed'></div>
		<div data-role='content' data-position='inline' >
			<input type='hidden' id='hidden_count' value='$hidden_count'>
			<div id='div_show' style='display:none;text-align:center;font-size:48pt;'></div>
			<div id='div_btn' class='center-button'><input type='button' id='btn_go' data-icon='check' data-iconpos='top' value='吃什麼' data-inline='true' onclick='onclkGo();'></div>
		</div>
		$footerNav_index
	</div>
		
	<div id='div_settingPage' data-role='page'>
		<script type='text/javascript'>
		$( document ).delegate('#div_settingPage', 'pageinit', function() {
			$('a[fType=del]').unbind().bind( 'click', function() {
		  		onclkDel($(this));
			});
			$('a[fType=add]').unbind().bind( 'click', function() {
		  		onclkAdd($(this));
			});
		});
		</script>
		<div data-role='header' data-position='fixed'></div>
		<div data-role='content' data-position='inline' >
		<div class='ui-grid-a'>
    		<div class='ui-block-a'>
				<input type='text' id='txt_add' data-clear-btn='true' data-theme='c' value='在這裡輸入' data-inline='true'></div>
			<div class='ui-block-b'>
				<a href='#' fType='add' data-role='button' data-icon='plus' data-iconpos='notext' data-inline='true' data-theme='b'></a></div>
		</div>
		<div>
	
		<ul id='ul_list' data-role='listview' data-split-icon='minus' data-theme='c' data-split-theme='c' data-inset='true'>
		$list_food</ul>
		</div>
		$footerNav_setting
		</div>
	</div>
</body></html>";
	echo $str;
}

function ajaxHandle($req) {
	switch($req) {
		case 'rand':
			if(!is_array($_SESSION['myFood']) || count($_SESSION['myFood']) == 0) {
				return ERROR_EMPTY_SESSION.']['.'都沒有資料耶, 先去設定吧';
			}
			return $_SESSION['myFood'][rand(0,(count($_SESSION['myFood'])-1))].']['.'';
			break;
		case 'onclkDel':
			$key = array_search($_POST['fVal'],$_SESSION['myFood']);
			array_splice($_SESSION['myFood'],$key,1);
			return $_POST['fVal'];
			break;
		case 'onclkAdd':
			array_push($_SESSION['myFood'],$_POST['txt_add']);
			return getli($_POST['txt_add']);
			break;
	}
}

?>