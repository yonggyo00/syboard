<?php
$_seq = 0;
if ( ($in['module'] == 'post' && $in['action'] == 'view' && $in['seq'] ) || ( $in['module'] == 'post' && $in['action'] == 'update' && $in['seq']) || ( $in['module'] == 'post' && $in['action'] == 'delete' && $in['seq']) ) {
	$_seq = $in['seq'];
	
}
else {
	$_number_mode = false;
	if ( isset($_GET) && count($_GET) == 1 ) {
		foreach ($_GET as $key => $value ) {
			if ( is_numeric($key) && empty($value) ) {
				$_seq = $key;
				$in['seq'] = $_seq;
				unset($in[0]);
				
				$_number_mode = true;
			}
		}
		
		if ( $_number_mode ) {
			$_init_path = CONTROLLER_PATH . '/module/post/init.php';
			$_path = CONTROLLER_PATH . '/module/post/view.php';
		}
	}
}
if ( $_seq ) {
	
	// 글 조회수를 증가 시킨다. 이미 본 글은 증가 시키지 않는다.
	include_once CONTROLLER_PATH . '/increase.view.php';
	$p = array();
	$p = $sy['post']->single_post($_seq);
}

if ( $p ) $in['post_id'] = $p['post_id'];
?>