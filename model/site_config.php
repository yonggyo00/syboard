<?php
// 사이트 설정 가져오기  1차, 2차 도메인만 체크 한다.
if ( sub_domain() ) $domain = sub_domain().".".root_domain();
else $domain = root_domain();

$filename = CACHE_PATH . '/site_config_'.$domain.".cache";

if ( file_exists( $filename ) ) {
	$sy['debug']->log("CACHE - $filename (Using Site Config Cache File)");
	$site_config = $sy['file']->unscalar($sy['file']->read_file($filename));
}
else {
	$sy['debug']->log("CACHE - $filename (Creating new Site Config Cache File)");
	$site_config = $sy['db']->row("SELECT * FROM ". SITE_CONFIG ." WHERE domain = '".$domain."'");


	$data = $sy['file']->scalar($site_config);

	$sy['file']->write_file($filename, $data);
}
?>