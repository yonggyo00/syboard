<?=skin_css($so, __FILE__)?>
<?php
$vs = $so['visitor_stat'];
if ( !$title = $so['title'] ) $title = lang('Visitor stat title');
?>
<div id='visitor-stat-default-skin'>
	<div id='title'><?=$title?></div>
	<div class='row'>
		<span class='sub-title'><?=lang('Visitor stat today')?></span><?=number_format($vs['today'])?>
	</div>
	<div class='row'>
		<span class='sub-title'><?=lang('Visitor stat yesterday')?></span><?=number_format($vs['yesterday'])?>
	</div>
	<div class='row'>
		<span class='sub-title'><?=lang('Visitor stat 1week')?></span><?=number_format($vs['week'])?>
	</div>
	<div class='row'>
		<span class='sub-title'><?=lang('Visitor stat 1month')?></span><?=number_format($vs['month'])?>
	</div>
	<div class='row'>
		<span class='sub-title'><?=lang('Visitor stat 1year')?></span><?=number_format($vs['year'])?>
	</div>
</div>