<?php
// 사이트별 추가 언어 디렉토리 경로
define(EXTRA_LANG_PATH, INDEX_PATH .'/'.$site_config['layout'].'/lang');

if ( $_GET['lang'] && $_GET['lang'] != 1 ) {
	setcookie('lang', $_GET['lang'], time() + ( 60 * 60 * 24 * 365), "/");
	// 쿠키 반영을 위해 새로고침 한다.
	header("Location: ".site_url());
}

if ( !$_lang = $_COOKIE['lang'] ) {
	$_lang = user_language();
}

// 언어에 맞게 언어별로 해석된 배열 데이터를 가져온다. 언어 배열은 $_ln으로 저장 되며 lang() 함수와 함께 사용할 수 있다.
$_ln = load_lang($_lang);
?>