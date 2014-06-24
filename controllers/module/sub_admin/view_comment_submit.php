<?php
if ( empty($in['seq']) ) return $sy['js']->alert("잘못된 접근 입니다.");
else {
	$result = null;
	foreach ( $in['seq'] as $seq ) {
		$result = $sy['db']->delete(COMMENT_DATA_TABLE, array('seq'=>$seq));
	}
	
	if ( $result ) {
		echo "<script>parent.location.reload()</script>";
	}
}
?>