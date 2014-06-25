<?php
if ( $_FILES['file-upload']['error'] ) {
	$sy['js']->alert(lang('File_uploader_submit error1'));
}
else {
	if ( $_FILES['file-upload']['size'] >= MAX_VIDEO_FILE_SIZE ) {
		$sy['js']->alert(lang('FIle_uploader_submit error2').round( MAX_VIDEO_FILE_SIZE / 1000000). lang('FIle_uploader_submit error3'));
	}
	else {
		if ( $sy['file']->is_video($_FILES['file-upload']['type']) ) {
			$option = array(
						'gid' => $in['gid'],
						'filename' => $_FILES['file-upload']['name'],
						'mime' => $_FILES['file-upload']['type'],
						'size' => $_FILES['file-upload']['size'],
						'width' => 0,
						'type'=>'video'
						
			);
			
			$insert_id = $sy['data']->insert_file_info($option);
			
			if ( $insert_id ) {
				$upload_path = $sy['data']->upload_path($insert_id);
				
				$result = @move_uploaded_file($_FILES['file-upload']['tmp_name'], $upload_path);
				
				if ( $result ) {
					$filepath = site_url() . "/" . $upload_path;
				?>
					<script>
						$(document).ready(function(){
							var video = "<video controls >" + 
										"<source src='<?=$filepath?>' type='video/mp4' />"+	
										"</video>";
										parent.insert_content_to_editor( video );
										parent.update_file_info ('<?=$insert_id?>', '<?=$_FILES['file-upload']['name']?>', '<?=$filepath?>', 0);
										parent.update_file_into_form ( <?=$insert_id?>, 'video');
						});
					</script>
			<?php
				}
			}
			else {
				$sy['js']->alert(lang('FIle_uploader_submit error4'));
			}
		}
		else {
			$sy['js']->alert(lang('FIle_uploader_submit error6'));
		}
	}
}
?>