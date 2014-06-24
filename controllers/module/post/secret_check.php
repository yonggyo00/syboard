<form method='post' target='hiframe' autocomplete='off'>
	<input type='hidden' name='module' value='post' />
	<input type='hidden' name='action' value='secret_check_submit' />
	<input type='hidden' name='layout' value=1 />
	<input type='hidden' name='seq' value='<?=$in['seq']?>' />
	
<?php
	if ( !$secret_check_skin = $site_config['secret_check_skin'] ) $secret_check_skin = 'default';
	load_skin('secret_check', $secret_check_skin);
?>
</form>