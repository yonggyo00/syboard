<?php
if ( $_seq ) {
	if ( !$sy['post']->check_view_count($_seq) ) {
		$sy['post']->increase_view_count($_seq);
	}
}
?>