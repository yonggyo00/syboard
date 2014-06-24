<?php
if ( empty($in['seq'] ) ) return $sy['js']->alert("잘못된 접근 입니다.");

if ( $sy['post']->post_cfg_update($in) ) {
	
	// 기존 게시판 설정 캐시`를 삭제한다.
	$filename = CACHE_PATH . '/post_cfg_'.$in['post_id'].'.cache';

	if ( file_exists($filename) ) {
		$sy['debug']->log("CACHE - $filename (Deleting Post Config(".$in['post_id'].") Cache)");
		@unlink($filename);
	}
	
	echo "
		<script>
			alert('수정되었습니다.');
			parent.location.reload();
		</script>
	";
}
?>