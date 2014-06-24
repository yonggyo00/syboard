<?php
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