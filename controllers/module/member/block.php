<?php
if ( admin() || $sy['post']->admin() || site_admin() ) {
	if ( empty($in['seq']) ) return $sy['js']->alert("잘못된 접근 입니다.");

	if ( $in['mode'] == 'comment' ) {
		if ( $block_no = $sy['mb']->check_comment_block($in['seq']) ) return $sy['js']->alert("이미 차단되었습니다. 차단 번호  $block_no");
		
		if ( $insert_id = $sy['mb']->comment_block($in['seq']) ) {
			$sy['js']->alert("차단 되었습니다. 차단 번호 $insert_id");
		}
		else $sy['js']->alert("차단에 실패하였습니다."); 
	}
	else {
		if ( $block_no = $sy['mb']->check_block($in['seq']) ) return $sy['js']->alert("이미 차단되었습니다. 차단 번호  $block_no");

		if ( $insert_id = $sy['mb']->block($in['seq']) ) {
			$sy['js']->alert("차단 되었습니다. 차단 번호 $insert_id");
		}
		else $sy['js']->alert("차단에 실패하였습니다."); 
	}
} else $sy['js']->alert("관리자가 아닙니다.");
?>