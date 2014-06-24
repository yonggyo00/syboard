<?php
if ( !$sy['mb']->is_login() ) return $sy['js']->location("로그인을 해 주세요", site_url() );
else {
	if ( $sy['mb']->resign() ) $msg = "탈퇴 되었습니다.";
	else $msg = "탈퇴에 실패하였습니다.";
	
	$sy['js']->location($msg, site_url());
}
?>