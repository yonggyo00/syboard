<?php
	if ( $sy['mb']->is_login() ) return $sy['js']->location("로그인 하셨습니다.", site_url());
?>
<form method='post' autocomplete='off'>
	<input type='hidden' name='layout' value=1 />
	<input type='hidden' name='header' value=1 />
	<input type='hidden' name='module' value='member' />
	<input type='hidden' name='action' value='login' />
	<input type='hidden' name='mode' value='page' />
<?php
	if ( !$login_page_skin = $site_config['login_page_skin'] ) $login_page_skin = 'default';
	load_skin('login_page', $login_page_skin, array('title'=>'로그인'));
?>
</form>
