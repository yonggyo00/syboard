<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location("로그인한 후에는 아이디/비밀번호 찾기를 하실 수 없습니다.", site_url());

echo module_css(__FILE__);

if ( $in['option'] == 'username' ) include_once 'find_username.php';
else if ( $in['option'] == 'password' ) include_once 'find_password.php';
else {?>
	<div id='find-username-password'>
		<span id='title'>아이디/비밀번호 찾기</span>
		<form method='get'>
			<input type='hidden' name='module' value='member' />
			<input type='hidden' name='action' value='find_username_password' />
			<input type='radio' name='option' value='username' />아이디 찾기&nbsp;&nbsp;&nbsp;
			<input type='radio' name='option' value='password' />비밀번호 찾기
			<div id='submit-button'><input type='submit' value='선택' /></div>
		</form>
	</div>
<? }?>