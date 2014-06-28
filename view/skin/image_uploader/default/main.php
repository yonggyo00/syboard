<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
include_once CONTROLLER_PATH . '/max_file_size.php';

 // gid에 이미 등록된 이미지가 있는지 확인 한다.
 if ( $so['gid'] ) {
	$file = $sy['file']->files_by_gid($so['gid']);
	if ( $file[0] ) {
		if ( !$width = $so['width'] ) $width = 100;
		if ( !$height = $so['height'] ) $height = 100;
		
		$image = "<img src='".imageresize ( $file[0]['seq'], $width, $height)."' />";
		
	} else $image = null;
	
 }
?>
<div id='image-uploader-skin'>
	<div id='image'><?=$image?></div>
	<form id='image-uploader-form' enctype='multipart/form-data' method='post' target='hiframe'>
		<input type='hidden' name='module' value='data' />
		<input type='hidden' name='action' value='image_upload_submit' />
		<input type='hidden' name='callback' value='image_upload_done' />
		<input type='hidden' name='code' value='<?=$so['code']?>' />
		<input type='hidden' name='gid' value='<?=$so['gid']?>' />
		<input type='hidden' name='width' value='<?=$so['width']?>' />
		<input type='hidden' name='height' value='<?=$so['height']?>' />
		<input type='hidden' name='layout' value=1 />
		
		<div>
			<span id='sub-title'><?=lang('image uploader skin title')?></span>(<?=lang('File_uploader max')?> <?=round( MAX_IMAGE_FILE_SIZE / 1048576 )?>MB, <?=lang('File_uploader support type')?> - png, jpeg, gif)
			<input type='file' name='file'/>
		</div>
	</form>
</div>