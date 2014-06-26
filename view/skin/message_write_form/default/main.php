<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<table id='message-write-form-skin' cellspacing=0 cellpadding=0 width='100%' border=0>
	<tr valign='top'>
		<td width='28%'>
			<?php
				include_once 'left.php';
			?>
		</td>
		<td width='72%'>
			<div id='user-info'>
				<table cellpadding=0 cellspacing=0 width='100%'>
					<tr align='top'>
						<td width=100><span class='sub-title'><?=lang('message write main sender')?></span></td> 
						<td width=5></td>
						<td><input type='text' name='sender' value='<?=$_member['username']?>' placeholder='보내는 사람' /></td>
					</tr>
					<tr valign='top'>
						<td width=100><span class='sub-title'><?=lang('message write main receiver')?></span></td>
						<td width=5></td>
						<td><input type='text' name='receiver' value='<?=$in['receiver']?>' placeholder='받는 사람' /></td>
					</tr>
				</table>
			</div>
			<div id='subject'><span class='sub-title'><?=lang('message write main subject')?></span><input type='text' name='subject' value='<?=$in['subject']?>' /></div>
			<textarea name='content'></textarea>
		</td>
	</tr>
</table>