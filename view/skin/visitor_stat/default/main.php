<?=skin_css($so, __FILE__)?>
<?php
$vs = $so['visitor_stat'];
if ( !$title = $so['title'] ) $title = "방문자 통계";
?>
<div id='visitor-stat-default-skin'>
	<div id='title'><?=$title?></div>
	<div class='row'>
		<span class='sub-title'>오늘</span><?=number_format($vs['today'])?>
	</div>
	<div class='row'>
		<span class='sub-title'>어제</span><?=number_format($vs['yesterday'])?>
	</div>
	<div class='row'>
		<span class='sub-title'>일주일</span><?=number_format($vs['week'])?>
	</div>
	<div class='row'>
		<span class='sub-title'>한달</span><?=number_format($vs['month'])?>
	</div>
	<div class='row'>
		<span class='sub-title'>일년</span><?=number_format($vs['year'])?>
	</div>
</div>