<?php
// 카테고리 정보를 가져온다.
$_category_tmp = explode(",", $post_cfg['category']);

$_category = array();

foreach ( $_category_tmp as $c ) {
	$c_tmp = explode("|", $c );
	
	if ( count($c_tmp) > 1 ) {
		$cat = $c_tmp[0];
		unset($c_tmp[0]);
		$_category[$cat] = $c_tmp;
	}
	else $_category[$c_tmp[0]] = array();
}
?>