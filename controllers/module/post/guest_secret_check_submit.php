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
		else $sy['js']->alert(lang('Guest_secret_check error1'));
	}
	else $sy['js']->alert(lang('Guest_secret_check error2'));
}
else $sy['js']->alert(lang('Guest_secret_check error3'));
?>