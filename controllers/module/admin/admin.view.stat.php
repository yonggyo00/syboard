<?php
$stamp_today = stamp_today();
$stamp_tomorrow = stamp_today() + ( 60 * 60 * 24 );
$stamp_yesterday = stamp_today() - ( 60 * 60 * 24 );
	
$stamp_this_week = $stamp_today  - ( 60 * 60 * 24 * 7 );
	
$stamp_this_month = stamp_this_month();
$stamp_next_month = stamp_next_month();

$stamp_this_year = stamp_this_year();
$stamp_next_year = stamp_next_year();

$stat = array();

$count_yesterday = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$in['domain']."' AND stamp >= $stamp_yesterday AND stamp < $stamp_today");

$count_today = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$in['domain']."' AND stamp >= $stamp_today AND stamp < $stamp_tomorrow");
	
$count_week = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$in['domain']."' AND stamp >= $stamp_this_week AND stamp < ".time());
	
$count_month = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$in['domain']."' AND stamp >= $stamp_this_month AND stamp < $stamp_next_month");

$count_year = $sy['db']->row("SELECT COUNT(*) as cnt FROM " .VISITOR_STAT_TABLE . " WHERE `domain`='".$in['domain']."' AND stamp >= $stamp_this_year AND stamp < $stamp_next_year");

$_visitor_stat['yesterday'] = $count_yesterday['cnt'];
$_visitor_stat['today'] = $count_today['cnt'];
$_visitor_stat['week'] = $count_week['cnt'];
$_visitor_stat['month'] = $count_month['cnt'];
$_visitor_stat['year'] = $count_year['cnt'];
?>
<div id='admin-stat'>
	<div class='admin-title'>도메인 - <?=$in['domain']?></div>
	<div class='admin-row'>
		<span class='sub-title'>어제</span><?=number_format($_visitor_stat['yesterday'])?>
	</div>
	<div class='admin-row'>
		<span class='sub-title'>오늘</span><?=number_format($_visitor_stat['today'])?>
	</div>
	<div class='admin-row'>
		<span class='sub-title'>일주일</span><?=number_format($_visitor_stat['week'])?>
	</div>
	<div class='admin-row'>
		<span class='sub-title'>한달</span><?=number_format($_visitor_stat['month'])?>
	</div>
	<div class='admin-row'>
		<span class='sub-title'>일년</span><?=number_format($_visitor_stat['year'])?>
	</div>
</div>