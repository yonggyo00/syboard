<?php
// 로그인을 한 경우만 다음의 코드가 실행이 된다.
if ( !$sy['mb']->is_login() ) return $sy['js']->alert(lang('My_post error1'));

// 해킹에 의한 부정 삭제를 방지하기 위해 본인의 글이 아니면 삭제 하지 못하도록 한다.
if ( $in['seq_member'] != $_member['seq'] ) return $sy['js']->alert(lang('My_post error2'));

foreach ( $in['seq'] as $seq ) {
	$sy['post']->delete($seq);
}
?>
<script>
	parent.location.reload();
</script>