<?php
if ( $sy['mb']->is_login()) {
echo module_css(__FILE__);
echo module_javascript(__FILE__);

include_once 'editor_js.php';

$gid = gid();
?>
<div id='message-write-module'>
	<form method='post' target='hiframe' autocomplete='off'>
		<input type='hidden' name='module' value='message' />
		<input type='hidden' name='action' value='write_submit' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='gid' value='<?=$gid?>' />
		<input type='hidden' name='first_file' />
	<?php
	if ( !$message_write_form_skin = $site_config['message_write_form_skin'] ) $message_write_form_skin = 'default';
	load_skin('message_write_form', $message_write_form_skin);
	?>
	<div id='submit-button'>
		<input type='submit' value='<?=lang('message list send')?>' />
		<input type='reset' value='<?=lang('message list reset')?>' />
	</div>
	</form>
	<div id='message-file-uploader'>
		<?include_once 'file_uploader.php';?>
	</div>
	<?}
	else $sy['js']->location(lang('message list error1'), "?");	
	?>
</div>