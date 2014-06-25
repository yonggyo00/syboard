<?php
if ( !$sy['mb']->is_login() ) return $sy['js']->back(lang('member update error1'));

if ( !$register_skin = $site_config['register_skin'] ) $register_skin = 'default';
load_skin('register', $register_skin, array('mode'=>'update', 'title'=>lang('member update title')));
?>