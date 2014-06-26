<?php
include_once 'editor_comment_js.php';

echo module_css(__FILE__);
?>
<div class='comment-reply-write-form'>
	<form method='post' target='hiframe' autocomplete='off'>
		<input type='hidden' name='module' value='post' />
		<input type='hidden' name='action' value='comment.reply.form_submit' />
		<input type='hidden' name='seq_root' value='<?=$in['seq_root']?>' />
		<input type='hidden' name='seq_parent' value='<?=$in['seq_parent']?>' />
		<input type='hidden' name='list_order' value='<?=$in['list_order']?>' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='post_id' value='<?=$in['post_id']?>' />
	<?php	
		if ( empty($post_cfg['use_login_post']) && !$sy['mb']->is_login() ) {
			echo "<div class='comment-extra-info-box'>". 
					"<div class='row'>
						<span class='sub-title'>".lang('Comment_form poster')."</span><input type='text' name='guest_username' placeholder='".lang('Comment_form poster')."' />".
						"<span class='sub-title'>".lang('Comment_form password')."</span><input type='password' name='secret' placeholder='".lang('Comment_form password_msg')."' />
					</div>
			";
			
			if ( $site_config['use_captcha'] ) {
				echo "<div class='row'><span class='sub-title'>".lang('Comment_form captcha')."</span>";
				if ( !$captcha_skin = $site_config['captcha_skin'] ) $captcha_skin = 'default';
				load_skin('captcha', $captcha_skin);
				echo "</div>";
			}
			echo "</div>";
			
		}
	?>	
		<textarea name='content'>@<?=$in['nickname']?>...&nbsp;&nbsp;</textarea>
		<div style='margin-top: 5px; text-align: right;' >
			<input type='submit' value='<?=lang('Comment_form write')?>' />
			<input type='reset' value='<?=lang('Comment_form reset')?>' />
		</div>
	</form>
</div>