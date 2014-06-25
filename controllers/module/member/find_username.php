<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location(lang('member find_username error1'), site_url());
?>

<div id='find-username-password'>
	<span id='title'><?=lang('member find_username find_username')?></span>
	<form method='post' autocomplete='off'>
		<input type='hidden' name='module' value='member' />
		<input type='hidden' name='action' value='find_username_check' />
		<center>
			<table id='text-box-group' cellpadding=0 cellspacing=0>
				<tr>
					<td><span class='sub-title'><?=lang('member find_username name')?></span></td><td width=10></td><td><input type='text' name='name' /></td>
				</tr>
				<tr>
					<td><span class='sub-title'><?=lang('member find_username registered_email')?></span><td width=10></td><td><input type='text' name='email' /></td>
				</tr>
			</table>
		</center>
		<div id='submit-button'><input type='submit' value='<?=lang('member find_username submit')?>' /></div>
	</form>
</div>