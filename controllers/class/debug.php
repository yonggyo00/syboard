<?php
class debug {
	function log( $message ) {
		global $sy, $site_config;
		
		if ( $site_config['use_debuging_log'] ) {
			$message = "[".date("H:i:s")."]".$message."\r\n";
			$filename = 'data/log/'.date('Ymd')."_".$site_config['domain'].".log";
			$sy['file']->write_file($filename, $message, 'a+');
		}
	}
	
}
?>