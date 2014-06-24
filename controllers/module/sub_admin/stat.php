<?=module_css(__FILE__)?>
<div id='sub-admin'>
	<div class='title'>방문자 통계</div>
	<div class='sub-admin-row'><span class='sub-title'>어제</span><?=number_format($_visitor_stat['yesterday'])?></div>
	<div class='sub-admin-row'><span class='sub-title'>오늘</span><?=number_format($_visitor_stat['today'])?></div>
	<div class='sub-admin-row'><span class='sub-title'>일주일</span><?=number_format($_visitor_stat['week'])?></div>
	<div class='sub-admin-row'><span class='sub-title'>한달</span><?=number_format($_visitor_stat['month'])?></div>
	<div class='sub-admin-row'><span class='sub-title'>일년</span><?=number_format($_visitor_stat['year'])?></div>
</div>