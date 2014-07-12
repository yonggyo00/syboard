<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<div class='calendar-skin-default'>
	<div id='top-pannel'>
		<span id='prev'>이전</span>
		<span id='next'>다음</span>
	</div>
	<div id='title'><?=date("Y년 m월")?></div>
	<div>
		<div class='cel day red'>일</div>
		<div class='cel day'>월</div>
		<div class='cel day'>화</div>
		<div class='cel day'>수</div>
		<div class='cel day'>목</div>
		<div class='cel day'>금</div>
		<div class='cel day blue'>토</div>
		<div style='clear:left;'></div>
	</div>
	<div id='date-container' year='<?=date('Y')?>' month='<?=date('m')?>'>
	<?php
		include_once 'content.php';
		
		
	?>
	</div>
</div>