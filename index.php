<?php
/************************************************************
 *                                                          *
 * PHPROCKS.COM SYBOARD Version 0.2                         *
 * Copyright(C) 2014, 만든이 이용교(LEE, YONGGYO)           *
 * 이 소스는 GPL 라이센스로 배포됩니다.                     *
 * 수정 및 상업적인 용도로 사용하셔도 무방하오나,           *
 * 출처 및 만든이 관련 주석은 제거하지 마십시오.            *
 * 만든이 이메일 - lyonggyo@gmail.com                       *
 *                                                          *
 * 사용법                                                   *
 * http://www.phprocks.com의 SYBOARD 설치 및 사용법을       *
 * 참고하세요.                                              *
 *                                                          *
 *                                                          *
 ************************************************************
*/

	// 초기화 파일
	include_once 'init/init.php';
	
	$favicon = null;
	if ( $site_config['favicon_uploaded'] ) {
		ob_start();
?>
		<link rel="shortcut icon" href="<?=FAVICON_PATH?>/<?=$site_config['domain']?>.ico" type="image/x-icon">
		<link rel="icon" href="<?=FAVICON_PATH?>/<?=$site_config['domain']?>.ico" type="image/x-icon">
<?php
		$favicon = ob_get_clean();
	}
?>
<? if ( empty($in['header']) ) {?>
<!DOCTYPE html>
<html>
<head>
	<meta name="description" content="<?=$_meta_desc?>" />
	<meta name="keywords" content="<?=$_meta_keyword?>" />
	<meta charset='UTF-8' />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?=$_meta_title?></title>
	<?=$favicon?>
	<link rel='stylesheet' type='text/css' href='<?=LIB_JS_PATH?>/jquery-ui/jquery-ui.min.css' />
	<link rel='stylesheet' type='text/css' href='css/index.css' />
	<script src='<?=LIB_JS_PATH?>/jquery/jquery.js'></script>
	<script src='<?=LIB_JS_PATH?>/jquery-ui/jquery-ui.min.js'></script>
	<? if ( $_lang == 'ko-KR' ) {?>
			<script src='<?=LIB_JS_PATH?>/jquery-ui/jquery.ui.datepicker-ko.js'></script>
	<? }?>
	<?php
		// 자바스크립트 메세지
		include_once CONTROLLER_PATH .'/js.msg.php';
	?>
	<script src='js/index.js' /></script>
	<?php 
		include_once css_header_path();
		foreach ( $css_header as $_css_header ) {
			echo $_css_header;
		}
		
		include_once js_header_path();
		foreach ( $js_header as $_js_header ) {
			echo $_js_header;
		}
	?>
</head>
<body>
<?php
// 팝업 설정, 팝업은 첫페이지 인 경우만 나타난다.
if ( first_page() ) include_once MODEL_PATH . '/popup_config.php';

	if ( $site_config['use_facebook'] ) { /* 페이스북 LIKE, SHARE 연동 */?>
		<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en-US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
	<?}?>
<? }?>
<?php	
	// 레이아웃
	if ( empty($site_config['layout']) ) $site_config['layout'] = 'default';
	include_once 'view/index/'.$site_config['layout'].'/layout.php';
	
	// hidden iframe 
?>
<?php if ( empty($in['header']) ) {?>	
<iframe name='hiframe' width='70%' style='border: 1px solid #666666; height: 500px; display: none;'></iframe>
</body>
</html>
<? }?>