<?=module_css(__FILE__)?>
<?php
include_once MODULE_PATH . '/post/editor_comment_js.php';
?>
<div id='edit-schedule'>
	<form method='post' target='hiframe'>
		<input type='hidden' name='module' value='calendar' />
		<input type='hidden' name='action' value='edit_schedule_submit' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='date' value='<?=$in['date']?>' />
			<table cellpadding=0 cellspacing=0 width='100%' border=0>
				<tr class='tr-header'>
					<td>시간</td>
					<td>스케줄</td>
				</tr>
			<?php
			// 오전
			for ( $i = 6; $i < 24; $i++ ) {
				if ( $i < 10 ) $i = "0".$i;
			?>
				<tr valign='top'>
					<td width=40><?=$i?>:00</td>
					<td><textarea name="schedule[<?=$i?>00]"><?=$cal->load_schedule($in['date'], $i."00")?></textarea></td>
				</tr>
				
				<tr valign='top'>
					<td width=40><?=$i?>:30</td>
					<td><textarea name="schedule[<?=$i?>30]"><?=$cal->load_schedule($in['date'], $i."30")?></textarea></td>
				</tr>
			<?}?>
				<tr valign='top'>
					<td width=40>24:00</td>
					<td><textarea name="schedule[2400]"><?=$cal->load_schedule($in['date'], "2400")?></textarea></td>
				</tr>
				
				<tr>
					<td width=40>24:30</td>
					<td><textarea name="schedule[2430]"><?=$cal->load_schedule($in['date'], "2430")?></textarea></td>
				</tr>
			<?php	
			for ( $i = 1; $i < 6; $i++ ) {	
				if ( $i < 10 ) $i = "0".$i;
			?>	
				<tr valign='top'>
					<td width=40><?=$i?>:00</td>
					<td><textarea name="schedule[<?=$i?>00]"><?=$cal->load_schedule($in['date'], $i."00")?></textarea></td>
				</tr>
				
				<tr valign='top'>
					<td width=40><?=$i?>:30</td>
					<td><textarea name="schedule[<?=$i?>30]"><?=$cal->load_schedule($in['date'], $i."30")?></textarea></td>
				</tr>
			<?}?>
		</table>
		<input type='submit' value='스케줄 등록' />
		<div style='clear:right;'></div>
	</form>
</div>