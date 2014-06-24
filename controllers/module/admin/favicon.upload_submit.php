<?php
if ( $in['mode'] == 'delete' ) {
	$new_file_name = FAVICON_PATH . "/".$in['domain'].".ico";
	if ( @unlink($new_file_name) ) {
		$sy['db']->update(SITE_CONFIG, array('favicon_uploaded'=>0), array('seq'=>$in['seq']));
		
		// 업데이트 되는 경우는 캐쉬 파일을 삭제 한다.
		$filename = CACHE_PATH . '/site_config_'.$in['domain'].".cache";
		if ( file_exists($filename) ) {
					@unlink($filename);
		}
		echo "<script>parent.location.reload()</script>";
	}
	
}
else {
	if ( $_FILES ) {
		
		if ( $_FILES['file_ico']['error'] ) return $sy['js']->alert("파비콘 이미지 업로드 중에 에러가 발생하였습니다.");
		else {
			// 타입 확인 image/x-icon
			if ( $_FILES['file_ico']['type'] != 'image/x-icon' ) return $sy['js']->alert("이미지는 반드시 ico 형식만 업로드 해 주세요.");
			else {
				$new_file_name = FAVICON_PATH . "/".$in['domain'].".ico";
				if ( $result = @move_uploaded_file($_FILES['file_ico']['tmp_name'], $new_file_name) ) {
				
					// favicon_uploaded를 1로 변경 한다.
					$sy['db']->update(SITE_CONFIG, array('favicon_uploaded'=>1), array('seq'=>$in['seq']));
					
					// 업데이트 되는 경우는 캐쉬 파일을 삭제 한다.
					$filename = CACHE_PATH . '/site_config_'.$in['domain'].".cache";
					if ( file_exists($filename) ) {
						@unlink($filename);
					}
					
					
					echo "<script>parent.location.reload()</script>";
				}
				
			}
		}
	}
}
?>