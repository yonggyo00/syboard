<?php
if ( $site_config['use_captcha'] ) {
	if ( $_SESSION['captcha'] != md5($in['captcha']) ) return $sy['js']->alert('보안문자를 정확하게 입력하세요');
}

if ( empty($in['seq']) ) return $sy['js']->alert("잘못된 접근 입니다.");

if ( !$sy['mb']->is_login() ) return $sy['js']->alert("잘못된 접근 입니다.");
else {
	if ( $_member['seq'] != $in['seq'] ) return $sy['js']->alert("잘못된 접근 입니다.");
	
	if ( $in['password'] && $in['confirm_password'] ) {
		if ( strlen($in['password']) < 4 ) return $sy['js']->alert("비밀번호는 4자 이상 입력하세요.");
		if ( $in['password'] != $in['confirm_password'] ) return $sy['js']->alert("비밀번호를 정확하게 입력하세요.");
	}
	else if (  $in['password'] && empty($in['confirm_password']) ) return $sy['js']->alert("비밀번호를 변경하실려면 비밀번호 확인에 입력하신 비밀번호를 재입력하세요.");
}

// 닉네임 체크
if ( $in['nickname'] ) {
	if ($sy['mb']->check_account_nickname_for_cannot_be_used( $in['nickname'] )) {
		return $sy['js']->alert( $in['nickname'].'은(는) 닉네임으로 사용하실 수 없습니다.' );
	}
}

// 이름 체크
if ( $in['name'] ) {
	if ($sy['mb']->check_name_for_cannot_be_used( $in['name'] ) ) {
		return $sy['js']->alert( $in['name'].'은(는) 이름으로 사용하실 수 없습니다.' );
	}
}

// 회원정보 수정 완료 전 콜백
if ( function_exists('before_edit_profile_submit_done') ) {
		before_edit_profile_submit_done();
}

if ( $sy['mb']->update($in) ) {
	// 업데이트가 완료 되면 업로드된 프로파일 이미지의 finished를 Y로 변경 한다. 
	$sy['db']->update(DATA_TABLE, array('finished'=>'Y'), array('gid'=>$in['gid']));
	
	$sy['js']->alert("수정 되었습니다.");
	echo "<script>parent.location.reload()</script>";
}

?>