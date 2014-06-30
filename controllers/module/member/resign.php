<?php
if ( !$sy['mb']->is_login() ) return $sy['js']->location("로그인을 해 주세요", "?");
else {
?>
	<div id='resign-module'>
		<form method='post'>
			<input type='hidden' name='module' value='member' />
			<input type='hidden' name='action' value='resign_submit' />
			<input type='hidden' name='layout' value=1 />
		<?php
			if ( !$resign_skin = $site_config['resign_skin'] ) $resign_skin = 'default';
			load_skin('resign', $resign_skin);
		?>
		</form>
	</div>
<?}?>