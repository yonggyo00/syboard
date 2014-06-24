<?php
$filename = CACHE_PATH . '/visitor_stat_'.$site_config['domain'].'.cache';
if ( file_exists ( $filename ) ) {
	$stamp = filemtime( $filename );
	
	if ( $stamp <= time() - ( 60 * $site_config['visitor_stat_minutes']) ) {
		$sy['debug']->log("CACHE - $filename (Visitor Stat Cache has been deleted now)");
		@unlink($filename);
	}
}

if ( file_exists ( $filename ) ) {
	$sy['debug']->log("CACHE - $filename (Currently using Visitor Stat Cache)");
	
	$_visitor_stat = array();
	$_visitor_stat = $sy['file']->unscalar($sy['file']->read_file($filename));
} else {
	$sy['debug']->log("CACHE - $filename (Creating New Visitor Stat Cache)");
	$stamp_today = stamp_today();
	$stamp_tomorrow = stamp_today() + ( 60 * 60 * 24 );
	$stamp_yesterday = stamp_today() - ( 60 * 60 * 24 );
	
	$stamp_this_week = $stamp_today  - ( 60 * 60 * 24 * 7 );
	
	$stamp_this_month = stamp_this_month();
	$stamp_next_month = stamp_next_month();

	$stamp_this_year = stamp_this_year();
	$stamp_next_year = stamp_next_year();

	$stat = array();

	$count_yesterday = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$site_config['domain']."' AND stamp >= $stamp_yesterday AND stamp < $stamp_today");

	$count_today = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$site_config['domain']."' AND stamp >= $stamp_today AND stamp < $stamp_tomorrow");
	
	$count_week = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$site_config['domain']."' AND stamp >= $stamp_this_week AND stamp < ".time());
	
	$count_month = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$site_config['domain']."' AND stamp >= $stamp_this_month AND stamp < $stamp_next_month");

	$count_year = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$site_config['domain']."' AND stamp >= $stamp_this_year AND stamp < $stamp_next_year");

	$_visitor_stat['yesterday'] = $count_yesterday['cnt'];
	$_visitor_stat['today'] = $count_today['cnt'];
	$_visitor_stat['week'] = $count_week['cnt'];
	$_visitor_stat['month'] = $count_month['cnt'];
	$_visitor_stat['year'] = $count_year['cnt'];

	$data = $sy['file']->scalar($_visitor_stat);
	$sy['file']->write_file($filename, $data);
}
?>