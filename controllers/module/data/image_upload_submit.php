<?php
include_once CONTROLLER_PATH . '/max_file_size.php';

if ( $_FILES['file']['error'] ) $sy['js']->alert(lang('File_uploader_submit error1'));
else {
	if ( $_FILES['file']['size'] >= MAX_IMAGE_FILE_SIZE ) {
		return $sy['js']->alert(lang('FIle_uploader_submit error2').round( MAX_IMAGE_FILE_SIZE / 1048576 ) . lang('FIle_uploader_submit error3'));
	}
	else {
		if ( $sy['file']->is_image($_FILES['file']['type']) ) {
		
			// 테이블에 추가 하기 전에 기존에 추가 했던 데이터와 업로드 된 파일을 제거 한다. 
			// 여기서는 이미지는 단 1개만 업로드 되기 때문이다.
			$sy['file']->deleted_file_by_gid( $in['gid'] );
		
			$imagesize = getimagesize($_FILES['file']['tmp_name']);
			$option = array(
							'gid' => $in['gid'],
							'filename' => $_FILES['file']['name'],
							'mime' => $_FILES['file']['type'],
							'size' => $_FILES['file']['size'],
							'width' => $imagesize[0],
							'height' => $imagesize[1],
							'type'=>'image'
							
			);
				
			if ( $in['code'] ) $option['code'] = $in['code'];
			
			$insert_id = $sy['data']->insert_file_info( $option );
			
			if( $insert_id ) {
				$upload_path = $sy['data']->upload_path($insert_id);
					
				$result = @move_uploaded_file($_FILES['file']['tmp_name'], $upload_path); 
	
				if ( $result ) {
					if ( !$width = $in['width'] )  $width = 100;
					if ( !$height = $in['height'] ) $height = 100;
					
					// 떰네일을 지정된 값으로 생성한다.
					$resized_image_path = imageresize ( $insert_id, $width, $height );
					
					if ( $callback = $in['callback'] ) {
					
						echo "
							<script>
								$(document).ready(function() {
									parent.{$callback}('$resized_image_path');
								});
							</script>
						";
					}
						
				}
			}
			else {
				$sy['js']->alert(lang('FIle_uploader_submit error4'));
			}	
		}else $sy['js']->alert(lang('FIle_uploader_submit error5'));
	}
}
?>