<?php
if(!is_array($_SESSION['myFood'])) {
	$_SESSION['myFood'] = array();
}

define('VERSION', '1.0');
define('ERROR_EMPTY_SESSION', -1001);
$hidden_count = 5;
$jobj_tag = json_encode(
	array(
		array(
			"icon" => 'home',
			"href" => "#div_indexPage",
			"text" => "首頁"
		),
		array(
			"icon" => 'info',
			"href" => "#div_aboutPage",
			"text" => "關於"
		),
		array(
			"icon" => 'gear',
			"href" => "#div_settingPage",
			"text" => "設定"
		)	
	)
);

function getFooterNav($jobj) {
	$html_btn = '';
	for($i=0; $i < count($jobj); $i++) {
		//$class_active = ($jobj[$i]->active == 1 ? 'ui-btn-active' : '');
		$html_btn .= "<li><a data-icon='".$jobj[$i]->icon."' href='".$jobj[$i]->href."'>".$jobj[$i]->text."</a></li>";
	}
	
	$str="
	<div data-role='footer' data-position='fixed'>
	    <div data-role='navbar'>
	        <ul>
	            $html_btn
	        </ul>
	    </div><!-- /navbar -->
	</div><!-- /footer -->";
	
	return $str;
}

function getli($val) {
	$ret = "<li fVal='$val'><a href='#'>
			<h2>$val</h2>
			</a><a href='#' fType='del' fVal='$val'>刪這筆</a>
		</li>";
		
	return $ret;
}
?>