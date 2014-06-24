<?php
if ( $in['mode'] == 'delete_all' ) {
	if ( empty($in['post_id']) ) return $sy['js']->alert("잘못된 접근 입니다.");
	else {
		// 삭제 표시된 글의 첨부 파일을 삭제한다.
		
		$posts = $sy['db']->rows("SELECT gid FROM " . POST_DATA_TABLE . " WHERE `post_id`='".$in['post_id']."' AND `deleted`='Y'");
		
		foreach ( $posts as $post ) {
			$sy['file']->deleted_file_by_gid($post['gid']);
		}
		
		$sy['db']->delete(POST_DATA_TABLE, array('post_id'=>$in['post_id'], 'deleted'=>'Y'));
		
		// 게시판 총 글 갯수를 사이트 설정에 반영한다.
		$sy['post']->update_total_post($in['post_id']);
	}
	
}
else if ( $in['mode'] == 'delete_comment_all' ) {
	// 모든 삭제표시 댓글 삭제한다.
	$sy['db']->delete(COMMENT_DATA_TABLE, array('deleted'=>'Y'));
}
else if ( $in['mode'] == 'update_total_post' ) {
	// 게시판 총 글 갯수를 사이트 설정에 반영한다.
	$sy['post']->update_total_post($in['post_id']);
}
else if ( $in['mode'] == 'recover' ) {
	$sy['db']->update(POST_DATA_TABLE, array('deleted'=>'N'), array('seq'=>$in['seq']));
}
else {
	if ( empty($in['seq']) ) return $sy['js']->alert("삭제할 글을 선택해 주세요.");

	foreach ( $in['seq'] as $seq ) {
	
		// 삭제 표시된 글의 첨부 파일을 삭제한다. 
		$post = $sy['post']->single_post($seq, "gid");
		echo $sy['file']->deleted_file_by_gid($post['gid']);
		
		
		$sy['db']->delete(POST_DATA_TABLE, array('seq'=>$seq));
		
		// 해당글에 연결된 댓글 역시 삭제한다.
		$sy['db']->delete(COMMENT_DATA_TABLE, array('seq_root'=>$seq));
	}
	
	// 게시판 총 글 갯수를 사이트 설정에 반영한다.
	$sy['post']->update_total_post($in['post_id']);
}
?>
<script>parent.location.reload();</script>