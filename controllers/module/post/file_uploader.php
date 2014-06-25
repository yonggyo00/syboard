<form method='post' id='write-file-uploader' target='hiframe' enctype='multipart/form-data'>
	<input type='hidden' name='module' value='post' />
	<input type='hidden' name='action' value='image_uploader_submit' />
	<input type='hidden' name='layout' value=1 />
	<input type='hidden' name='gid' value='<?=$gid?>' />
	<input type='file' name='file-upload' />
</form>
<div id="file_info">
<?php 
	if ( $in['action'] == 'update' ) {
		$images = $sy['file']->files_by_gid( $gid );
		
		foreach ( $images as $image ) {
			$upload_path = $sy['data']->upload_path($image['seq']);
			$filepath = site_url() . '/'. $upload_path;
		?>
			<span class='row' file_no='<?=$image['seq']?>' file_url='<?=$filepath?>' image_width='<?=$image['width']?>'>
				<?=$image['filename']?>
				<span class='delete_file'><?=lang('File_uploader delete')?></span>
				<span class='insert_content'><?=lang('File_uploader insert_into_content')?></span>
			</span>
	<?
		}
	}
?>
</div>