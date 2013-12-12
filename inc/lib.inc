<?
if(!is_array($_SESSION['myFood'])) {
	$_SESSION['myFood'] = array();
}

define('ERROR_EMPTY_SESSION', -1001);

$hidden_count = 5;
$ary_food = array(
	'巧福',
	'賣當勞',
	'肯的雞',
	'李記蒸餃',
	'老向',
	'快炒',
	'燒臘',
	'藍天',
	'逢甲'
);

$jobj_tag = json_encode(
	array(
		array(
			"icon" => 'home',
			"href" => "#div_indexPage",
			"text" => "首頁",
			"active" => "0"
		),
		array(
			"icon" => 'gear',
			"href" => "#div_settingPage",
			"text" => "設定",
			"active" => "0"
		)	
	)
);

function getFooterNav($jobj) {
	for($i=0; $i < count($jobj); $i++) {
		$class_active = ($jobj[$i]->active == 1 ? "class='ui-btn-active'" : '');
		$html_btn .= "<li><a data-icon='".$jobj[$i]->icon."' href='".$jobj[$i]->href."' $class_active>".$jobj[$i]->text."</a></li>";
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