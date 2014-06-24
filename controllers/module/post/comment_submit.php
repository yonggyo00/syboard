<?php
if ( empty($post_cfg['use_login_post']) && !$sy['mb']->is_login() ) {
	if ( empty($in['guest_username']) ) return $sy['js']->alert("글쓴이를 입력하세요.");
	if ( strlen($in['guest_username']) > 12 ) return $sy['js']->alert("글쓴이는 영문 12, 한글 4자 이하로 입력하세요.");
	
	if ( empty($in['secret']) ) return $sy['js']->alert("비밀번호를 입력하세요.");
	if ( strlen($in['secret']) != 6 ) return $sy['js']->alert("비밀번호는 6자로 입력하세요.");
	
	if ( $site_config['use_captcha'] ) {
		if ( $_SESSION['captcha'] != md5($in['captcha']) ) return $sy['js']->alert("보안 문자를 정확하게 입력하세요.");
	}
}

// 레벨 확인
$point = $sy['mb']->my_point();
if ( $sy['mb']->level($point) < $post_cfg['comment_write_level'] ) {
	return $sy['js']->alert("레벨이 부족하여 댓글을 쓸 수 없습니다.");
}

if ( $in['content'] ) {
	$insert_id = $sy['post']->write_root_comment($in);
	if ( $insert_id ) {
		// 포인트를 업데이트 한다. 포인트는 반드시 로그인 한 경우만 증가한다.
		if ( $sy['mb']->is_login() ) {
			$sy['mb']->update_my_point(1);
		}

		echo "
			<script>
				$(document).ready(function() {
					parent.comment_done();
				});
			</script>	
		";
	}
} else $sy['js']->alert("댓글을 작성해 주세요.");
?>