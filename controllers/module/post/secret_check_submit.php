<?php
if ( $in['seq'] ) {
	if ( $in['post_secret'] ) {
		if ( strlen($in['post_secret']) == 6 ) {
			$_SESSION['post_no_'.$in['seq']."_secret"] = md5($in['post_secret']);
			
			echo "
				<script>
					parent.location.href='".$sy['post']->view_url($in['seq'])."';
				</script>
			";
		}
		else $sy['js']->alert("숫자 또는 영문의 6자리 비밀번호를 입력하세요.");
	}
	else $sy['js']->alert("비밀번호를 입력하세요.");
}
else $sy['js']->alert("잘못된 접근 입니다.");
?>