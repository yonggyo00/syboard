<?php
if ( $_FILES['file-upload']['error'] ) {
	$sy['js']->alert("파일 업로드 중 에러가 발생하였습니다.");
}
else {
	if ( $_FILES['file-upload']['size'] >= MAX_IMAGE_FILE_SIZE ) {
		$sy['js']->alert("파일 용량은 ".round( MAX_IMAGE_FILE_SIZE / 1000000 ) . "MB 이하로 해 주세요");
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
								var image = "<div style='max-width: <?=$image_width?>px;'><img src='<?=$filepath?>' style='width: 100%' class='content_image_popup'/>";
								parent.insert_content_to_editor( image );
								parent.update_file_info ('<?=$insert_id?>', '<?=$_FILES['file-upload']['name']?>', '<?=$filepath?>', '<?=$image_width?>');
								parent.update_file_into_form ( <?=$insert_id?>, 'image');
							});
						</script>
	<?php
				}
			}
			else {
				$sy['js']->alert("파일 정보 업데이트에 실패 하였습니다.");
			}
		} else {
			$sy['js']->alert("지원하지 않는 이미지 타입 입니다. 이미지는 jpeg, gif, png 형식으로 변환하세요");
		}
	}
}
?>