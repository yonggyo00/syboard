<?php
$unfinished = $sy['file']->unfinished_file();
?>
<?=module_javascript(__FILE__)?>
<div id='admin-file'>
	<form id='admin-file-form' method='post' target='hiframe'>
		<input type='hidden' name='module' value='admin' />
		<input type='hidden' name='action' value='admin.file_submit' />
		<input type='hidden' name='layout' value=1 />
		<div class='admin-title'>파일 관리</div>
		<div class='admin-sub-title'>완료되지 않은 파일</div>
<?php
	foreach ( $unfinished as $f ) {
		$checkbox = "<input type='checkbox' name='seq[]' value='$f[seq]' />";
		echo "
			<div class='row'>
				$checkbox $f[filename]
			</div>
		";
	}
?>	
		<span id='select-all'>전체선택</span>
		<input type='submit' value='삭제' />
	</form>
</div>