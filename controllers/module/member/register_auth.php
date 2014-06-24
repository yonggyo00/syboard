<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location("로그인 후에는 가입 하실 수 없습니다.", site_url());
?>
<script>
	var success_msg1 = "가입인증 주소가 전송 되었습니다. 회원님의 메일 ";
	var success_msg2 = "에서 가입인증 주소를 확인 해 주세요.";
	
	var fail_msg = "가입 인증메일 전송에 실패하였습니다.";
</script>
<?=module_css(__FILE__)?>
<?=module_javascript(__FILE__)?>
<div id='register-auth'>
	<div id='title'>회원 가입 이메일 인증</div>
	<form method='post' target='hiframe' autocomplete='off'>
		<input type='hidden' name='module' value='member' />
		<input type='hidden' name='action' value='register_auth_submit' />
		<input type='hidden' name='layout' value=1 />
		
		<span id='sub-title'>인증 이메일</span><input type='text' name='email' />
		<div id='submit-button'>
			<input type='submit' value='인증메일 보내기' />
		</div>
	</form>
	
	<div id='register-auth-message'></div>
</div>