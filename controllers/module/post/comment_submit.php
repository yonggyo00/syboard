<?php
if ( empty($post_cfg['use_login_post']) && !$sy['mb']->is_login() ) {
	if ( empty($in['guest_username']) ) return $sy['js']->alert(lang('Comment reply submit error1'));
	if ( strlen($in['guest_username']) > 12 ) return $sy['js']->alert(lang('Comment reply submit error2'));
	
	if ( empty($in['secret']) ) return $sy['js']->alert(lang('Comment reply submit error3'));
	if ( strlen($in['secret']) != 6 ) return $sy['js']->alert(lang('Comment reply submit error4'));
	
	if ( $site_config['use_captcha'] ) {
		if ( $_SESSION['captcha'] != md5($in['captcha']) ) return $sy['js']->alert(lang('Comment reply submit error5'));
	}
}

// 레벨 확인
$point = $sy['mb']->my_point();
if ( $sy['mb']->level($point) < $post_cfg['comment_write_level'] ) {
	return $sy['js']->alert(lang('Comment reply submit error6'));
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
} else $sy['js']->alert(lang('Comment reply submit error7'));
?>