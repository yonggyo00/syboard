<?php
include_once CONTROLLER_PATH . '/max_file_size.php';

if ( $_FILES['file-upload']['error'] ) return $sy['js']->alert(lang('File_uploader_submit error1'));

$option = array(
				'gid'=>$in['gid'],
				'filename' => $_FILES['ms-file']['name'],
				'mime' => $_FILES['ms-file']['type'],
				'size' => $_FILES['ms-file']['size'],
				'code' => 'message'
				 
 );
 
 if ( $sy['file']->is_image ($_FILES['ms-file']['type']) ) {
	
	if ( $_FILES['ms-file']['size'] >= MAX_IMAGE_FILE_SIZE ) {
		$sy['js']->alert(lang('FIle_uploader_submit error2').round( MAX_IMAGE_FILE_SIZE / 1048576 ) . lang('FIle_uploader_submit error3'));
	}
	else if ( $_FILES['ms-file']['size'] == 0 ) {
		return $sy['js']->alert(lang('File_uploader_submit error1'));
	}
	else {
		$imagesize = getimagesize($_FILES['ms-file']['tmp_name']);
		$option['width'] = $imagesize[0];
		$option['height'] = $imagesize[1];
		$option['type'] = 'image';
		$insert_id = $sy['data']->insert_file_info( $option );
		
		if ( $insert_id ) {
			$upload_path = $sy['data']->upload_path($insert_id);
				
			$result = @move_uploaded_file($_FILES['ms-file']['tmp_name'], $upload_path); 
	
			if ( $result ) {
				$filepath = site_url() . '/'. $upload_path;
				$image_width = $imagesize[0];
				if ( $image_width > 710 ) $image_width = 710;
				?>
				<script>
					$(document).ready(function(){
						var image = "<div style='max-width: <?=$image_width?>px;'><img src='<?=$filepath?>' style='width: 100%' />";
						parent.insert_content_to_editor_msg( image );
						
						parent.update_file_info_msg ('<?=$insert_id?>', '<?=$_FILES['ms-file']['name']?>', '<?=$filepath?>', '<?=$image_width?>');
						
					});
				</script>
		<?php
			}
		}
		
	}
 } else if ( $sy['file']->is_video( $_FILES['ms-file']['type']) ) {
	if ( $_FILES['ms-file']['size'] >= MAX_VIDEO_FILE_SIZE ) {
		return $sy['js']->alert(lang('FIle_uploader_submit error2').round( MAX_VIDEO_FILE_SIZE / 1048576 ) . lang('FIle_uploader_submit error3'));
	}
	else if ( $_FILES['ms-file']['size'] == 0 ) {
		return $sy['js']->alert(lang('File_uploader_submit error1'));
	}
	else {
		$option['width'] = 0;
		$option['type'] = 'video';
		
		$insert_id = $sy['data']->insert_file_info($option);
		
		if ( $insert_id ) {
			$upload_path = $sy['data']->upload_path($insert_id);
				
			$result = @move_uploaded_file($_FILES['ms-file']['tmp_name'], $upload_path);
			
			if ( $result ) {
					$filepath = site_url() . "/" . $upload_path;
				?>
					<script>
						$(document).ready(function(){
							var video = "<video controls >" + 
										"<source src='<?=$filepath?>' type='video/mp4' />"+	
										"</video>";
							parent.insert_content_to_editor_msg( video );
							
							parent.update_file_info_msg ('<?=$insert_id?>', '<?=$_FILES['ms-file']['name']?>', '<?=$filepath?>', 0);
						});
				</script>
		<?}?>
	<?}	
	}
 }
 else {
	if ( $_FILES['ms-file']['size'] >= MAX_FILE_UPLOAD_SIZE ) {
		return $sy['js']->alert(lang('FIle_uploader_submit error2').round( MAX_FILE_UPLOAD_SIZE / 1048576 ) . lang('FIle_uploader_submit error3'));
	}
	else if ( $_FILES['ms-file']['size'] == 0 ) {
		return $sy['js']->alert(lang('File_uploader_submit error1'));
	}
	else {
	
		$option['width'] = 1;
		$option['type'] = 'file';
		
		$insert_id = $sy['data']->insert_file_info($option);
		if ( $insert_id ) {
			$upload_path = $sy['data']->upload_path($insert_id);
					
			$result = @move_uploaded_file($_FILES['ms-file']['tmp_name'], $upload_path);
				
			if ( $result ) {
				$filepath = site_url() . "/" . $upload_path;
				?>
					<script>
						$(document).ready(function(){
							var file = "<div class='content-file-info' id='<?=$insert_id?>'><span class='content-filename'><?=$_FILES['ms-file']['name']?></span><span class='file-download'>DOWNLOAD</span></div><p>&nbsp;</p>";
							parent.insert_content_to_editor_msg( file );
							
							parent.update_file_info_msg ('<?=$insert_id?>', '<?=$_FILES['ms-file']['name']?>', '<?=$filepath?>', 1);
							
							parent.update_file_info_to_form_msg('<?=$insert_id?>');
						});
					</script>
				<?
			}
		}
	}
 }
?>