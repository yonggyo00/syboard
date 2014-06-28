<?php
include_once CONTROLLER_PATH . '/max_file_size.php';
?>
<div style='position: relative;'>
	<form id='file-uploader' enctype='multipart/form-data' method='post' target='hiframe'>
			<input type='hidden' name='module' value='message' />
			<input type='hidden' name='action' value='file_uploader_submit' />
			<input type='hidden' name='layout' value=1 />
			<input type='hidden' name='gid' value='<?=$gid?>' />
			<input type='file' name='ms-file' />
	</form>
	<span><?=lang('File_uploader image')?>(png,jpeg,gif) <?=lang('File_uploader max')?> <?=round( MAX_IMAGE_FILE_SIZE / 1048576 )?>MB, <?=lang('File_uploader video')?>(mp4) <?=lang('File_uploader max')?> <?=round( MAX_VIDEO_FILE_SIZE / 1048576 )?>MB, <?=lang('File_uploader file')?> <?=lang('File_uploader max')?> <?=round( MAX_FILE_UPLOAD_SIZE / 1048576 )?>MB</span>
	<div id="file_info"></div>
</div>