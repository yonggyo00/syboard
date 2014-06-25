<?=css('css', 'top')?>
<div id='site-top'>
	<a href='<?=site_url()?>'><?=lang('top home')?></a>
<?php
	if ( $sy['mb']->is_login() ) {?>
		<a href='?module=member&action=logout' target='hiframe'><?=lang('Login Logout')?></a>
		<a href='?module=member&action=update'><?=lang('Login edit profile')?></a>
<? } else {?>
	<a href='?module=member&action=login_page#login_box'><?=lang('Login Login')?></a>
	<a href='?module=member&action=register'><?=lang('Login Register')?></a>
<?}?>
<?php
	if ( !$mobile_pc_skin = $site_config['mobile_pc_skin'] ) $mobile_pc_skin = 'default';
	load_skin('mobile_pc', $mobile_pc_skin, array('device'=>$_device));
	
	if ( !$lang_skin = $site_config['lang_skin'] ) $lang_skin = 'default';
	load_skin('lang', $lang_skin, array('lang'=>$_lang));
?>
</div>