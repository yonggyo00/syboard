<?php
if ( empty($in['domain']) ) return $sy['js']->alert("추가할 도메인을 입력하세요.");

if ( $adm->add_popup_config($in['domain']) ) {
	$msg = "도메인(".$in['domain'].")의 팝업설정이 추가되었습니다.";
}
else $msg = "도메인(".$in['domain'].")의 팝업설정이 이미 존재합니다.";

$sy['js']->alert($msg);
?>
<script>parent.location.reload();</script>