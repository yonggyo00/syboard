<?php
// device 값이 넘어 왔다면, 쿠키를 지정한다. 
if ( $_GET['device'] ) {
	setcookie('device', $_GET['device'], time() + (60 * 60 * 24 * 365), "/", COOKIE_DOMAIN);
	// 쿠키 반영을 위해 새로고침 한다.
	header("Location: ?");
	
}
$_device = $_COOKIE['device'];

if ( isMobile() || (!isMobile() && $_device == 'mobile') ) {
	if ( $site_config['mobile_url'] ) header('Location: //'. $site_config['mobile_url']);
}
else {
	if ( $site_config['pc_url'] ) header('Location: //'. $site_config['pc_url']);
}
?>