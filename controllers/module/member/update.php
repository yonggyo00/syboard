<?php
if ( !$sy['mb']->is_login() ) return $sy['js']->back("로그인을 해 주세요.");

if ( !$register_skin = $site_config['register_skin'] ) $register_skin = 'default';
load_skin('register', $register_skin, array('mode'=>'update', 'title'=>'회원정보 수정'));
?>