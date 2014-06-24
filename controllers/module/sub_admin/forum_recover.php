<?php
if ( empty($in['seq']) ) return $sy['js']->alert("잘못된 접근 입니다.");

if ( $sy['db']->UPDATE(POST_DATA_TABLE, array('deleted'=>'N'), array('seq'=>$in['seq'])) ) {
	$msg = "복구 되었습니다.";
} else $msg = "복구에 실패하였습니다.";

$sy['js']->alert($msg);
?>
<script>parent.location.reload();</script>