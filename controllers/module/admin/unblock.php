<?php
if ( admin() ) {
	if ( empty($in['seq']) ) return $sy['js']->alert("잘못된 접근 입니다.");
	
	if ( $sy['mb']->unblock($in['seq']) ) {
		$sy['js']->alert("차단이 해제되었습니다.");
		echo "
			<script>
				parent.location.reload();
			</script>
		";
	}
	
} else $sy['js']->alert("관리자가 아닙니다.");
?>