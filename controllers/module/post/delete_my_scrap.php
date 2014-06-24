<?php
if ( empty($in['seq_scrap']) ) return $sy['js']->alert("잘못된 접근 입니다.");

$msg = null;
if ( $sy['post']->unscrap($in['seq_scrap']) ) {
	$msg = "삭제되었습니다.";
}
else $msg = "삭제에 실패하였습니다.";

$sy['js']->alert($msg);
?>
<script>
	parent.location.reload();
</script>