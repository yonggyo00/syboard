<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location(lang('member find_username_password error1'), "?");

echo module_css(__FILE__);

if ( $in['option'] == 'username' ) include_once 'find_username.php';
else if ( $in['option'] == 'password' ) include_once 'find_password.php';
else {?>
	<div id='find-username-password'>
		<span id='title'><?=lang('member find_username_password title')?></span>
		<form method='get'>
			<input type='hidden' name='module' value='member' />
			<input type='hidden' name='action' value='find_username_password' />
			<input type='radio' name='option' value='username' /><?=lang('member find_username_password find_username')?>&nbsp;&nbsp;&nbsp;
			<input type='radio' name='option' value='password' /><?=lang('member find_username_password find_password')?>
			<div id='submit-button'><input type='submit' value='<?=lang('member find_username_password submit')?>' /></div>
		</form>
	</div>
<? }?>