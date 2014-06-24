<?php
class data {
	
	public function insert_file_info( $option ) {
		global $sy;
		
		$option['stamp'] = time();
		
		return $sy['db']->insert(DATA_TABLE, $option);
	}
	
	public function upload_path ( $insert_id ) {
		$dir_name = ( $insert_id  % 10 );
		return UPLOAD_PATH . '/'.$dir_name .'/'. $insert_id;
		
	}
}
?>