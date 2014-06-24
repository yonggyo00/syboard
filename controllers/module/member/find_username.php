<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location("로그인한 후에는 아이디/비밀번호 찾기를 하실 수 없습니다.", site_url());
?>

<div id='find-username-password'>
	<span id='title'>아이디 찾기</span>
	<form method='post' autocomplete='off'>
		<input type='hidden' name='module' value='member' />
		<input type='hidden' name='action' value='find_username_check' />
		<center>
			<table id='text-box-group' cellpadding=0 cellspacing=0>
				<tr>
					<td><span class='sub-title'>가입시 성함</span></td><td width=10></td><td><input type='text' name='name' /></td>
				</tr>
				<tr>
					<td><span class='sub-title'>등록한 이메일</span><td width=10></td><td><input type='text' name='email' /></td>
				</tr>
			</table>
		</center>
		<div id='submit-button'><input type='submit' value='아이디 찾기' /></div>
	</form>
</div>