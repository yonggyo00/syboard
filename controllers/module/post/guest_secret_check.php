<form method='post' target='hiframe' autocomplete='off'>
	<input type='hidden' name='module' value='post' />
	<input type='hidden' name='action' value='guest_secret_check_submit' />
	<input type='hidden' name='layout' value=1 />
	<input type='hidden' name='seq' value='<?=$in['seq']?>' />
	<?if ( $in['post_id'] ) {?> 
		<input type='hidden' name='post_id' value='<?=$in['post_id']?>' />
	<?}?>
	<?if ( $in['mode'] ) {?>
		<input type='hidden' name='mode' value='<?=$in['mode']?>' />
	<?}?>
	
<?php
	if ( !$secret_check_skin = $site_config['guest_secret_check_skin'] ) $secret_check_skin = 'default';
	load_skin('guest_secret_check', $secret_check_skin);
?>
</form>