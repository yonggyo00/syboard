<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location("로그인 후에는 가입하실 수 없습니다.", site_url());

if ( $site_config['use_register_auth'] ) {
	if ( empty($in['auth_key'] ) ) return $sy['js']->location("가입 인증을 해 주세요.", site_url());
}

if ( !$register_skin = $site_config['register_skin'] ) $register_skin = 'default';
load_skin('register', $register_skin, array('title'=>'회원가입'));
?>