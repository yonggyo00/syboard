<?php
if ( $site_config['use_captcha'] ) {
	if ( $_SESSION['captcha'] != md5($in['captcha']) ) return $sy['js']->alert('보안문자를 정확하게 입력하세요');
}

if ( $in['username'] && $in['password'] && $in['confirm_password'] && $in['name'] && $in['nickname'] && $in['email'] ) {
	if ( strlen($in['username']) < 4 ) return $sy['js']->alert("아이디는 4자 이상 입력하세요.");
	if ( strlen($in['password']) < 4 ) return $sy['js']->alert("비밀번호는 4자 이상 입력하세요.");
	if ( strlen($in['nickname']) < 4 ) return $sy['js']->alert("닉네임은 4자 이상 입력하세요.");

	if ( $sy['mb']->username_check($in['username']) ) return $sy['js']->alert("아이디가 이미 존재합니다.");
	if ( $sy['mb']->nickname_check($in['nickname']) ) return $sy['js']->alert("닉네임이 이미 존재합니다.");
	
	if ($sy['mb']->check_account_nickname_for_cannot_be_used( $in['username'] )) {
		return $sy['js']->alert( $in['username'].'은(는) 아이디로 사용하실 수 없습니다.' );
	}
	
	if ($sy['mb']->check_account_nickname_for_cannot_be_used( $in['nickname'] )) {
		return $sy['js']->alert( $in['nickname'].'은(는) 닉네임으로 사용하실 수 없습니다.' );
	}
	
	if ($sy['mb']->check_name_for_cannot_be_used( $in['name'] ) ) {
		return $sy['js']->alert( $in['name'].'은(는) 이름으로 사용하실 수 없습니다.' );
	}
	
	// 이메일 체크
	if ( !isValidEmail($in['email'], true) ) return $sy['js']->alert("유효하지 않은 이메일 입니다.");
	
	// 이미 가입된 이메일인지 확인 한다.
	if ( $sy['mb']->check_email($in['email']) ) return $sy['js']->alert("이미 가입된 이메일 입니다.");
	
	if ( $in['password'] == $in['confirm_password'] ) {
		// 회원 가입 완료 전 콜백
		if ( function_exists('before_register_submit_done') ) {
			before_register_submit_done();
		}
		
		if ( $insert_id = $sy['mb']->register( $in ) ) {
			// 정상적으로 가입이 된 경우 가입 포인트를 업데이트 한다.
			
			if ( $site_config['register_point'] ) {
				$sy['db']->update(MEMBER_TABLE, array('point'=>$site_config['register_point']), array('seq'=>$insert_id));
			}
			
			// 업데이트가 완료 되면 업로드된 프로파일 이미지의 finished를 Y로 변경 한다. 
			$sy['db']->update(DATA_TABLE, array('finished'=>'Y'), array('gid'=>$in['gid']));
			
			$sy['js']->alert("가입되었습니다.");
		
			// 정상적으로 가입 된 경우 로그인을 시킨다.
			$sy['mb']->login($in['username'], $in['password']);
		} else return $sy['js']->alert("회원가입에 실패 하였습니다.");
		
		$pathinfo = pathinfo($_SERVER['REQUEST_URI']);
		if ( $pathinfo['dirname'] ) $url = $pathinfo['dirname'];
		else $url = '/';
	
		echo "
			<script>
				parent.location.href='$url';
			</script>
		";
	}
	else {
		$sy['js']->alert("비밀번호를 정확하게 입력하세요");
	}
} else {
	$sy['js']->alert("필수 항목을 모두 기입해 주세요.");
}
?>