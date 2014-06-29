<?php
include_once CONTROLLER_PATH . '/max_file_size.php';

if ( $_FILES['file-upload']['error'] ) {
	$sy['js']->alert(lang('File_uploader_submit error1'));
}
else {
	if ( $_FILES['file-upload']['size'] >= MAX_IMAGE_FILE_SIZE ) {
		$sy['js']->alert(lang('FIle_uploader_submit error2').round( MAX_IMAGE_FILE_SIZE / 1048576 ) . lang('FIle_uploader_submit error3'));
	}
	else {
		
		if ( $sy['file']->is_image($_FILES['file-upload']['type']) ) {
			$imagesize = getimagesize($_FILES['file-upload']['tmp_name']);
			
			$option = array(
						'gid' => $in['gid'],
						'filename' => $_FILES['file-upload']['name'],
						'mime' => $_FILES['file-upload']['type'],
						'size' => $_FILES['file-upload']['size'],
						'width' => $imagesize[0],
						'height' => $imagesize[1],
						'type'=>'image'
						
			);
			
			$insert_id = $sy['data']->insert_file_info( $option );
			
			if ( $insert_id ) {
				$upload_path = $sy['data']->upload_path($insert_id);
				
				$result = @move_uploaded_file($_FILES['file-upload']['tmp_name'], $upload_path); 
			
				if ( $result ) {
					$filepath = site_url() . '/'. $upload_path;
					$image_width = $imagesize[0];
					if ( $image_width > 710 ) $image_width = 710;
				?>
						<script>
							$(document).ready(function(){
								var image = "<div style='max-width: <?=$image_width?>px;'><img src='<?=$filepath?>' style='width: 100%' class='content_image_popup'/></div>";
								parent.insert_content_to_editor( image );
								parent.update_file_info ('<?=$insert_id?>', '<?=$_FILES['file-upload']['name']?>', '<?=$filepath?>', '<?=$image_width?>');
								parent.update_file_into_form ( <?=$insert_id?>, 'image');
							});
						</script>
	<?php
				}
			}
			else {
				$sy['js']->alert(lang('FIle_uploader_submit error4'));
			}
		} else {
			$sy['js']->alert(lang('FIle_uploader_submit error5'));
		}
	}
}
?>