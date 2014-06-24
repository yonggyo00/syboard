<?php
if ( empty($in['seq']) ) return $sy['js']->alert('잘못된 접근 입니다.');

if ( !$sy['mb']->is_login() ) return $sy['js']->alert("로그인을 해 주세요.");

if ( $sy['post']->is_scrapped($in['seq']) )  return $sy['js']->alert("이미 스크랩 되었습니다.");
else {
	if ( $sy['post']->scrap($in['seq']) ) {
		echo "
			<script>
				$(document).ready(function() {
					parent.scrap_done();
				});
			</script>
		";
	}
	else $sy['js']->alert("스크랩에 실패하였습니다.");

	
}
?>