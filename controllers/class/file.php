<?php
class file {
	
	public function write_file ( $filename, $data, $mode = 'wb' ) {
		$file = fopen( $filename, $mode );
		$result = fwrite( $file, $data );
		fclose( $file );
		
		return $result;
	}
	
	public function read_file ( $filename, $mode = 'rb' ) {
		$file = fopen( $filename, $mode );
		$contents = null;
		while ( !feof($file) ) {
			$contents .= fread($file, 512);
		}
		fclose($file);
		return $contents;
	}
	
	
	public function scalar ( $data ) {
		return base64_encode(serialize($data));
	}
	
	public function unscalar ( $data ) {
		return unserialize(base64_decode($data));
	}
	
	public function readdir( $path = '.' ) {
		$files = array();
		$d = dir( $path );
		while ( $file = $d->read() ) {
			if ( $file == '.' || $file == '..' ) continue;
			else $files[] = $file;
		}
		$d->close();
		
		if ( $files ) return $files;
	}

	public function is_image( $mime ) {
		
		$image_type = array(
			'image/jpeg', 
			'image/pjpeg', 
			'image/gif', 
			'image/png'
		);
		
		return in_array($mime, $image_type);
	}
	
	public function is_video ( $mime ) {
		if ( $mime ==  "video/mp4" ) return 1;
	}
	
	
	public function delete_image ( $seq ) {
		global $sy;
		
		// 파일 데이터를 삭제 한다.
		if ( $sy['db']->delete(DATA_TABLE, array('seq'=>$seq)) ) {
		
			$upload_path = $sy['data']->upload_path($seq);
			
			return @unlink($upload_path);
		}
		
	}
	
	public function files_by_gid( $gid ) {
		global $sy;
		
		return $sy['db']->rows("SELECT * FROM " . DATA_TABLE . " WHERE `gid` = '". $gid . "'");
	}
	
	public function images_by_gid ( $gid ) {
		global $sy;
		
		return $sy['db']->rows("SELECT * FROM " . DATA_TABLE . " WHERE `gid` = '". $gid . "' AND `type`='image'");
	}
	
	public function file_by_seq ( $seq ) {
		global $sy;

		return $sy['db']->row("SELECT * FROM ". DATA_TABLE . " WHERE `seq`=$seq");
	}
	
	
	public function file_insert_finished ( $gid ) {
		global $sy;
		
		return $sy['db']->update(DATA_TABLE, array('finished'=>'Y'), array('gid'=>$gid));
	}
	
	public function deleted_file_by_gid( $gid ) {
		global $sy;
		
		// 먼저 해당 gid에서 seq를 가져온다.
		$seqs = $sy['db']->rows("SELECt seq FROM " . DATA_TABLE . " WHERE `gid`= '".$gid."'");
		
		foreach ( $seqs as $s ) {
			// 업로드된 해당 파일을 모두 삭제하고
			@unlink($sy['data']->upload_path ( $s['seq'] ));
		}
		
		// 데이터 테이블에서 해당 gid의 기록을 삭제한다.
		return $sy['db']->delete(DATA_TABLE, array('gid'=>$gid));
	}
	
	public function unfinished_file( $fields = '*' ) {
		global $sy;
		
		return $sy['db']->rows("SELECT $fields FROM ".DATA_TABLE. " WHERE finished='N'"); 
	}
	
	/**
  * Changes permissions on files and directories within $dir and dives recursively
  * into found subdirectories.
  */
	public function chmod_r($dir, $dirPermissions, $filePermissions) {
		$dp = opendir($dir);
		  while($file = readdir($dp)) {
			 if (($file == ".") || ($file == ".."))
				continue;

			$fullPath = $dir."/".$file;

			 if(is_dir($fullPath)) {
				//echo('DIR:' . $fullPath . "\n");
				chmod($fullPath, $dirPermissions);
				chmod_r($fullPath, $dirPermissions, $filePermissions);
			 } else {
				//echo('FILE:' . $fullPath . "\n");
				chmod($fullPath, $filePermissions);
			 }

		   }
		 closedir($dp);
	}	
}
?>