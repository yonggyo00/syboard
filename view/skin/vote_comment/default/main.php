<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<table border=0 cellpadding=0 cellspacing=0 class="vote-comment" seq_comment='<?=$comment['seq']?>'>
	<tr valign='top'>
		<td width=60>
			<form method='post' target='hiframe'`>
				<input type='hidden' name='module' value='post' />
				<input type='hidden' name='action' value='vote_comment' />
				<input type='hidden' name='layout' value=1 />
				<input type='hidden' name='seq_comment' value='<?=$comment['seq']?>' />
				<input type='hidden' name='mode' value='good' />
				<input class='vote-button' type='submit' value='<?=lang('Vote_comment good')?>(<?=$comment['good']?>)' />	
			</form>
		</td>
		<td width=4></td>
		<td width=60>
			<form method='post' target='hiframe'`>
				<input type='hidden' name='module' value='post' />
				<input type='hidden' name='action' value='vote_comment' />
				<input type='hidden' name='layout' value=1 />
				<input type='hidden' name='seq_comment' value='<?=$comment['seq']?>' />
				<input type='hidden' name='mode' value='bad' />
				<input class='vote-button' type='submit' value='<?=lang('Vote_comment bad')?>(<?=$comment['bad']?>)' />	
			</form>
		</td>
	</tr>
</table>