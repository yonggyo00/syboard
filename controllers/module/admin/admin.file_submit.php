<?php
if ( empty($in['seq']) ) return $sy['js']->alert("삭제할 파일을 선택하세요.");
else {
	foreach ( $in['seq'] as $seq ) {
	
		// 실제 업로드 된 파일을 삭제 한다.
		$upload_path = $sy['data']->upload_path ( $seq );
		@unlink($upload_path);
		
		// 데이터 테이블의 데이터를 삭제한다.
		if ( $sy['db']->delete(DATA_TABLE, array('seq'=>$seq)) ) {
			$msg = "삭제되었습니다.";
		}
		else $msg = "삭제에 실패하였습니다.";
		
		echo "
			<script>
				alert('$msg');
				parent.location.reload();
			</script>
		";
	}
} 
?>