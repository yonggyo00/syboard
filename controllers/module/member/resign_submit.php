<?php
if ( !$sy['mb']->is_login() ) return $sy['js']->location(lang('member resign error1'), "?" );
else {
	if ( $sy['mb']->resign() ) $msg = lang('member resign success');
	else $msg = lang('member resign failed');
	
	$sy['js']->location($msg, "?");
}
?>