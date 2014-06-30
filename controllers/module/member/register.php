<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location(lang('Register notice1'), "?");

if ( $site_config['use_register_auth'] ) {
	if ( empty($in['auth_key'] ) ) return $sy['js']->location(lang('Register notice2'), "?");
}

if ( !$register_skin = $site_config['register_skin'] ) $register_skin = 'default';
load_skin('register', $register_skin, array('title'=>lang('Register title')));
?>