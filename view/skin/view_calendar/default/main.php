<?=skin_css($so, __FILE__)?>
<?php
$stamp = date2stamp($so['date']);
?>
<div id='view-calendar-default'>
	<div id='title'><?=date('Y년 m월 d일', $stamp)?></div>
<?php
if ( empty($so['schedule']) ) {
	echo "<div id='message'>등록된 스케줄이 없습니다.</div>";
}
else {?>
	<table cellpadding=0 cellspacing=0 width='100%' border=0>
		<tr valign='top' id='tr-header'>
			<td width=40>시간</td>
			<td>스케줄</td>
		</tr>
	<?php
	foreach ( $so['schedule'] as $s ) {
		$hour = substr($s['time'], 0, 2);
		$mins = substr($s['time'], 2, 2);
		$time = $hour.":".$mins;
	?>
		<tr>
			<td width=40><?=$time?></td>
			<td><?=$s['schedule']?></td>
		</tr>
	<?}?>
	</table>
<?}?>
</div>