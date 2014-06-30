<?=skin_css($so, __FILE__)?>
<input type='hidden' name='mode' value=1 />
<div id='message-write-form-skin'>
	<div id='title'><?=lang('message write title')?></div>
	<div id='user-info'>
		<table cellpadding=0 cellspacing=0 width='100%'>
			<tr align='top'>
				<td width=100><span class='sub-title'><?=lang('message write main sender')?></span></td> 
				<td width=5></td>
				<td><input type='text' name='sender' value='<?=$_member['username']?>' placeholder='<?=lang('message write main sender')?>' /></td>
			</tr>
			<tr valign='top'>
				<td width=100><span class='sub-title'><?=lang('message write main receiver')?></span></td>
				<td width=5></td>
				<td><input type='text' name='receiver' value='<?=$in['receiver']?>' placeholder='<?=lang('message write main receiver')?>' /></td>
			</tr>
		</table>
	</div>
	<div id='subject'><span class='sub-title'><?=lang('message write main subject')?></span><input type='text' name='subject' value='<?=$in['subject']?>' /></div>
	<textarea name='content'></textarea>
</div>