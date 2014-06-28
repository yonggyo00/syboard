<?php
include_once CONTROLLER_PATH . '/max_file_size.php';

if ( $_FILES['file-upload']['error'] ) {
	$sy['js']->alert(lang('File_uploader_submit error1'));
}
else {
	if ( $_FILES['file-upload']['size'] >= MAX_FILE_UPLOAD_SIZE ) {
		$sy['js']->alert(lang('FIle_uploader_submit error2').round( MAX_FILE_UPLOAD_SIZE / 1048576 ) . lang('FIle_uploader_submit error3'));
	}
	else {
		$option = array(
						'gid' => $in['gid'],
						'filename' => $_FILES['file-upload']['name'],
						'mime' => $_FILES['file-upload']['type'],
						'size' => $_FILES['file-upload']['size'],
						'width' => 1,
						'type'=>'file'
						
		);
		
		$insert_id = $sy['data']->insert_file_info ( $option );
		
		if( $insert_id ) {
			$upload_path = $sy['data']->upload_path($insert_id);
			
			$result = @move_uploaded_file($_FILES['file-upload']['tmp_name'], $upload_path);
			
			if ( $result ) {
				$filepath = site_url() . "/" . $upload_path;
				?>
					<script>
						$(document).ready(function(){
							var file = "<div class='content-file-info' id='<?=$insert_id?>'><span class='content-filename'><?=$_FILES['file-upload']['name']?></span><span class='file-download'>DOWNLOAD</span></div><p>&nbsp;</p>";
							parent.insert_content_to_editor( file );
							parent.update_file_info ('<?=$insert_id?>', '<?=$_FILES['file-upload']['name']?>', '<?=$filepath?>', 1);
							parent.update_file_into_form ( <?=$insert_id?>, 'file');
						});
					</script>
			<?php
			}
		}
		else {
			$sy['js']->alert(lang('FIle_uploader_submit error4'));
		}
	}
}
?>