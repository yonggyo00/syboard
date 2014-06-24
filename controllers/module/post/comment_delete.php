<?php
if ( $in['seq'] ) {

	if ( $sy['db']->update(COMMENT_DATA_TABLE, array('deleted'=>'Y'), array('seq'=>$in['seq'])) ) {
	
		// 변경된 코멘트 수 본글에 업데이트
		$count = $sy['db']->count(COMMENT_DATA_TABLE, array('seq_root'=>$in['seq_root'], 'deleted'=>'N'));
		
		$sy['db']->update(POST_DATA_TABLE, array('no_of_comment'=>$count), array('seq'=>$in['seq_root']));
		
		// 포인트 업데이트 
		if ( $sy['mb']->is_login() ) {
			$my_point = $sy['mb']->my_point();
			
			$update_points = $my_point - $post_cfg['comment_point'];
		
			if ( $update_points < 0 ) $update_points = 0;
			
			$sy['db']->update(MEMBER_TABLE, array('point'=>$update_points), array('seq'=>$_member['seq']));
		}
		
		echo "<script>
					alert('삭제 되었습니다.');
					parent.location.reload();
				</script>";
	}
}
else $sy['js']->alert("잘못된 접근 입니다.");
?>