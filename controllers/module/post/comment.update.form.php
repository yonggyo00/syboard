<?php
include_once 'editor_comment_js.php';

echo module_css(__FILE__);

if ( $in['seq'] ) {
	$comment = $sy['post']->single_comment($in['seq']);
?>
	<form method='post' class='comment-update-form' target='hiframe'>
		<input type='hidden' name='module' value='post' />
		<input type='hidden' name='action' value='comment.update.form.submit' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='seq' value='<?=$in['seq']?>' />
		
		<textarea name='content'><?=$comment['content']?></textarea>
		<input type='reset' value='<?=lang('Comment_form reset')?>' />
		<input type='submit' value='<?=lang('Comment_form write')?>' />
		<div style='clear:right;'></div>
	</form>
<?
}
else $sy['js']->alert(lang('Comment_delete error'));
?>