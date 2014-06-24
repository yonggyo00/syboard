<?php
// 금지어 체크 
if ( $blocked_words = $sy['post']->blocked_words($in['content']) ) return $sy['js']->alert( "금지어 ".$blocked_words."(이)가 포함되었습니다. 해당 단어를 제거해 주세요.");

if ( empty($post_cfg['use_login_post']) && !$sy['mb']->is_login() ) {
	if ( $site_config['use_captcha'] ) {
		if ( $_SESSION['captcha'] != md5($in['captcha']) ) {
			return $sy['js']->alert("보안문자를 정확하게 입력하세요.");
		}
		unset($in['captcha']);
	}
	// 게스트 사용자의 글쓰기인 경우는 guest_username을 학인 한다.
	
	if ( $in['mode'] != 'update' ) {
		if ( empty($in['guest_username']) ) return $sy['js']->alert("글쓴이를 입력하세요");
		else {
			if ( strlen($in['guest_username'] ) >= 15) return $sy['js']->alert("글쓴이는 한글 5자 또는 영문 15자 이내로 입력하세요.");
		}
		
		// 게스트 사용자의 글 비밀번호를 확인 한다.
		if ( empty($in['guest_secret']) ) return $sy['js']->alert("글 비밀번호를 입력하세요.");
		else {
			if ( strlen($in['guest_secret']) != 6 ) return $sy['js']->alert("비밀번호는 6자리의 영문, 숫자 조합으로 지정해 주세요.");
		}
	}
}

// 비밀글인 경우 6자리 인지 확인 한다.
if ( $post_cfg['use_secret'] ) {
	if ( $in['use_secret'] ) {
		if ( $in['secret'] ) {
			if ( strlen($in['secret']) != 6 ) return $sy['js']->alert("비밀번호는 6자리 이하로 등록해 주세요.");
		} else return $sy['js']->alert("비밀번호를 등록해 주세요.");
	}
}

// 글쓰기, 글 수정 완료 전
if ( function_exists('before_write_submit_done') ) {
	before_write_submit_done();
}


if ( $in['mode'] == 'update' ) {
	if (  $sy['post']->update($in) ) {
		// 파일 업데이트 finished 변경
		$sy['file']->file_insert_finished($in['gid']);
		
		// 블로그 API 처리
		include_once 'blog_api.php';
		
		
		// 총 글 갯수 업데이트
		$sy['post']->update_total_post($in['post_id']);
		
		echo "
			<script>
				parent.callback_write_done('$in[seq]');
			</script>
		";
	 }
}
else {
	if ( $insert_id = $sy['post']->write($in) ) {
		
		// 파일 업데이트 finished 변경
		$sy['file']->file_insert_finished($in['gid']);
		
		// 블로그 API 처리
		include_once 'blog_api.php';
		
		
		// 총 글 갯수 업데이트
		$sy['post']->update_total_post($in['post_id']);
		
		// 포인트를 업데이트 한다. 포인트는 반드시 로그인 한 경우만 증가한다.
		if ( $sy['mb']->is_login() ) {
			$sy['mb']->update_my_point();
		}
		
		if ( $post_cfg['use_secret'] && !$sy['mb']->is_login() && empty($sy['use_login_post'])) {
			// 게스트 사용자의 경우 세션에 글 비밀번호를 저장해 놓는다.
			$_SESSION['post_no_'.$insert_id."_secret"] = md5($in['secret']);
		}
		
		echo "
			<script>
				parent.callback_write_done('$insert_id');
			</script>
		";
		
	}
}
?>