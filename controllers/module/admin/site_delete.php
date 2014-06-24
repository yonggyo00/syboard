<?php
if ( $in['seq'] ) {
	if ( $sy['db']->delete( SITE_CONFIG, array('seq' => $in['seq'] ) ) ) $msg = '삭제되었습니다.';
	else $msg = '삭제에 실패 하였습니다.';
	
	$sy['js']->location( $msg, $_SERVER['REQUEST_URI'] );		
}
else $sy['js']->back( '비정상적인 접근 입니다.' );
?>