<?php
$_path = null;
$_init_path = null;  // 모듈 또는 스킨이 로드 되기 전에 먼저 로드 또는 처리되어야 하는 부분을 처리하는 init.php 경로

// 쿼리 스트링 형태로 입력되는 GET, POST 값들을 escape 스트링 처리 하고 merge 한다.
$_in = array_merge($_GET, $_POST);
$in = array();

// sql injection을 다음과 같이 걸러낼 수 있도록 한다.
foreach ( $_in as $key => $value ) {
	if ( is_array($value) ) {
		$in[$key] = $value;
		$value_tmp = array();
		
		// XSS 공격 방지 코드 
		foreach ( $value as $k => $v ) {
			$value_tmp[$k] =  xss_clean($v);
			$value_tmp[$k] = $sy['db']->escape($value_tmp[$k]);
		}
		
		$in[$key] = $value_tmp;
	}
	else {
		
		// XSS 공격 방지 코드
		$in[$key] = xss_clean($value);
		$in[$key] = $sy['db']->escape($in[$key]);
	}
}

$_string_mode = false;
// 게시글 번호가 있다면 게시글을 가져온다.
include_once MODEL_PATH . '/single_post.php';
$meta_post_content = $p;

// 게시판 아이디만 들어 왔다면
if ( isset($_GET) && count($_GET) == 1 ) {
	foreach ($_GET as $key => $value ) {
		if ( is_string($key) && empty($value) ) {
			$in['post_id'] = $key;
			unset($in[$key]);
			$_string_mode = true;
		}
	}
	if ( $_string_mode ) {
		$_init_path = CONTROLLER_PATH . '/module/post/init.php';
		$_path = CONTROLLER_PATH . '/module/post/list.php';
	}
}

ob_start();
$_keys = array();
foreach ( $in as $key => $value ) {
	$_keys[] = $key;
}

if ( in_array('module', $_keys) && in_array('action', $_keys) ) {	
	$_path = CONTROLLER_PATH . '/module/' . $in['module'] . "/" . $in['action'] .".php";
	$_init_path = CONTROLLER_PATH . '/module/' . $in['module'] . "/init.php";
}
else if ( in_array('page', $_keys) ) {
	if ( in_array('action', $_keys) ) {
		$_path = INDEX_PATH . "/" . $site_config['layout'] . "/" . $in['page'] . "." . $in['action'] . ".php";
	}
	else $_path = INDEX_PATH . "/" . $site_config['layout'] . "/" . $in['page'] . ".php";
}
else if ( in_array('skin', $_keys) && in_array('dir', $_keys) && in_array('file', $_keys) ) {
	$_path = SKIN_PATH ."/".$in['skin'] . "/" . $in['dir'] ."/".$in['file'].".php";
	$so = array(
				'path' => SKIN_PATH ."/".$in['skin'] . "/" . $in['dir'],
				'kind' => $in['skin'],
				'skin' => $in['dir']
	);
}

if ( $_init_path ) include_once $_init_path;
if ( $_path ) include_once $_path;

$_contents = ob_get_clean();
?>