<?=module_javascript(__FILE__)?>
<?php
$files = $sy['file']->readdir(CACHE_PATH);
?>
<div id='admin-cache' />
	<div class='admin-title'>캐시관리</div>
	<form method='post' target='hiframe'>
		<input type='hidden' name='module' value='admin' />
		<input type='hidden' name='action' value='cache_submit' />
		<input type='hidden' name='layout' value=1 />
	<?php
		foreach ( $files as $file ) {
			echo "
				<div class='row'>
					<input type='checkbox' name='file[]' value='".urlencode($file)."' />
					$file
				</div>
			";
		}
	?>
		<span id='select-all'>전체선택</span>
		<input type='submit' value='삭제' />
	</form>
</div>