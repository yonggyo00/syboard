<?=module_css(__FILE__)?>
<?=module_javascript(__FILE__)?>
<?php
$image = null;
$favicon_config = $adm->site_config($in['seq'], 'favicon_uploaded');
if ( $favicon_config['favicon_uploaded'] ) $image = "<img src='".FAVICON_PATH . '/'.$in['domain'].".ico' />";
?>
<? if ( $image ) {?>
	<div id='uploaded-favicon'><?=$image?></div>
	<form method='post' target='hiframe'>
		<input type='hidden' name='module' value='admin' />
		<input type='hidden' name='action' value='favicon.upload_submit' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='domain' value='<?=$in['domain']?>' />
		<input type='hidden' name='seq' value='<?=$in['seq']?>' />
		<input type='hidden' name='mode' value='delete' />
		<input type='submit' value='삭제하기' onclick="return confirm('정말로 삭제하시겠습니까?')"/>
		
	</form>
<?}?>
<div id='favicon-upload'>
	<form id='favicon-upload-form' method='post' enctype='multipart/form-data' target='hiframe'>
		<input type='hidden' name='module' value='admin' />
		<input type='hidden' name='action' value='favicon.upload_submit' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='domain' value='<?=$in['domain']?>' />
		<input type='hidden' name='seq' value='<?=$in['seq']?>' />
		파비콘 이미지 등록<input type='file' name='file_ico' />
	</form>
</div>