<?php
if ( $in['seq'] ) {

	if ( $in['content'] ) {
		$option = array(
						'content'=>$in['content'],
						'content_stripped'=>strip_tags($in['content'])
		);
		if ( $sy['db']->update(COMMENT_DATA_TABLE, $option, array('seq'=>$in['seq'])) ) {
			
			echo "<script>
						parent.parent.location.reload();
					</script>";
			
		} else $sy['js']->alert("글쓰기에 실패하였습니다.");
	}
	else $sy['js']->alert("내용을 입력하세요.");
} else $sy['js']->alert("잘못된 접근입니다.");
?>