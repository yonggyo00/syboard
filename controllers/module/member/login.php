<?php
// 로그인 정보는 base64_encode 형태로 쿠키에 저장이 된다.
if ( $in['username'] && $in['password'] ) {
	if ( $sy['mb']->is_resign($in['username']) ) return $sy['js']->alert(lang('Login error1'));
	
	if ( $sy['mb']->login($in['username'], $in['password'], $in['auto_login'], $in['ip_sec']) ) {
		
		if ( $in['mode'] == 'page' ) {
			header("Location: ?");
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
		$msg = lang('Login error2');
		if ( $in['mode'] == 'page' ) $sy['js']->back($msg);
		else $sy['js']->alert($msg);
	}
}
else {
	$msg = lang('Login error3');
	if ( $in['mode'] == 'page' ) $sy['js']->back($msg);
	else $sy['js']->alert($msg);
}
?>