<?php
if ( empty($in['seq']) ) return $sy['js']->alert("잘못된 접근 입니다.");
else {
	$result = null;
	foreach ( $in['seq'] as $seq ) {
		// 글에 포함된 파일을 모두 삭제한다.
		$p = $sy['post']->single_post($seq, 'gid');
		
		$sy['file']->deleted_file_by_gid($p['gid']);
		
		// 해당 글을 삭제한다.
		$result = $sy['db']->delete(POST_DATA_TABLE, array('seq'=>$seq));
	}
	
	if ( $result ) {
		echo "<script>parent.location.reload()</script>";
	}
}
?>