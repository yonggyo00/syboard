<?php
// 로그인 정보는 base64_encode 형태로 쿠키에 저장이 된다.
if ( $in['username'] && $in['password'] ) {
	if ( $sy['mb']->is_resign($in['username']) ) return $sy['js']->alert('탈퇴한 회원입니다.');
	
	if ( $sy['mb']->login($in['username'], $in['password'], $in['auto_login']) ) {
		
		if ( $in['mode'] == 'page' ) {
			header('Location: '.site_url());
		}
		else {
			echo "
				<script>
					parent.location.reload();
				</script>
			";
		}
	}
	else {
		$msg = "존재하지 않은 아이디거나 비밀번호가 정확하지 않습니다.";
		if ( $in['mode'] == 'page' ) $sy['js']->back($msg);
		else $sy['js']->alert($msg);
	}
}
else {
	$msg = "아이디와 비밀번호를 모두 입력해 주세요";
	if ( $in['mode'] == 'page' ) $sy['js']->back($msg);
	else $sy['js']->alert($msg);
}
?>