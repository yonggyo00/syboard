<?php
if ( empty($in['file']) ) return $sy['js']->alert("삭제할 파일을 선택하세요");

foreach ( $in['file'] as $file ) {
	@unlink(USERS_PATH . "/".$file);
}
?>
<script>
	parent.location.reload();
</script>