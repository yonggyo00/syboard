<?php
if ( $in['seq'] ) {
	$uploaded_path = $sy['data']->upload_path($in['seq']);
	$file_info = $sy['file']->file_by_seq($in['seq']);
	
	if( file_exists($uploaded_path) ) {
		
		if ( !is_dir(DOWNLOAD_PATH . '/'.get_browser_id()) ) {
			mkdir(DOWNLOAD_PATH . '/'.get_browser_id(), 0777); // 다운로드 경로가 없는 경우 생성한다.
		}
		
		$download_path = DOWNLOAD_PATH . '/'.get_browser_id()."/".urlencode($file_info['filename']);
		
		$file_data = $sy['file']->read_file($uploaded_path);
		$result = $sy['file']->write_file($download_path, $file_data);
		
		if (file_exists($download_path) && $file_info['size'] == $result) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($download_path));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($download_path));
			ob_clean();
			flush();
			readfile($download_path);
				exit;
		}
		else {
			$sy['js']->alert("파일 전송중, 에러가 발생하였습니다.");
		}
	}
	else {
		$sy['js']->alert("파일이 존재하지 않습니다.");
	}
}
else $sy['js']->alert("잘못된 접근 입니다.");
?>