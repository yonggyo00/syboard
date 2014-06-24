<form id='file-uploader' enctype='multipart/form-data' method='post' target='hiframe'>
	<input type='hidden' name='module' value='message' />
	<input type='hidden' name='action' value='file_uploader_submit' />
	<input type='hidden' name='layout' value=1 />
	<input type='hidden' name='gid' value='<?=$gid?>' />
	<input type='file' name='ms-file' />
</form>
<div id="file_info"></div>