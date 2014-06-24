<?php
// 게시판 환경 설정 정보 가져오기
$filename = CACHE_PATH . '/post_cfg_'.$in['post_id'].'.cache';

if ( file_exists($filename) ) {
	$sy['debug']->log("CACHE - $filename (Using Post Config(".$in['post_id'].") Cache)");
	
	$post_cfg = $sy['file']->unscalar($sy['file']->read_file($filename));
}
else {
	$sy['debug']->log("CACHE - $filename (Creating Post Config(".$in['post_id'].") Cache)");
	
	$post_cfg = $sy['post']->post_cfg($in['post_id']);
	
	$data = $sy['file']->scalar($post_cfg);
	$sy['file']->write_file($filename, $data);
}
?>