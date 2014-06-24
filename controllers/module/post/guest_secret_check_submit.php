<?php
if ( $in['seq'] ) {
	if ( $in['guest_secret'] ) {
		if ( strlen($in['guest_secret']) == 6 ) {
			
			$_SESSION['post_no_'.$in['seq']."_guest_secret"] = md5($in['guest_secret']);
			
			if ( $in['mode'] && $in['post_id'] ) { // 삭제인 경우
				$url = $sy['post']->delete_url($in['seq'], $in['post_id']);
			} else { // 글 수정
				$url = $sy['post']->update_url($in['seq']);
			}
			
			echo "
				<script>
					parent.location.href='".$url."';
				</script>
			";
		}
		else $sy['js']->alert("숫자 또는 영문의 6자리 글 비밀번호를 입력하세요.");
	}
	else $sy['js']->alert("글 비밀번호를 입력하세요.");
}
else $sy['js']->alert("잘못된 접근 입니다.");
?>