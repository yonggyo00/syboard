<?php
include_once 'editor_comment_js.php';
echo module_css(__FILE__);
echo module_javascript(__FILE__);
?>
<div id="comment-form">
	<form method='post' target='hiframe' autocomplete='off'>
		<input type='hidden' name='module' value='post' />
		<input type='hidden' name='action' value='comment_submit' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='seq_root' value='<?=$in['seq']?>' />
		<input type='hidden' name='post_id' value='<?=$in['post_id']?>' />
		<?php
		
		if ( empty($post_cfg['use_login_post']) && !$sy['mb']->is_login() ) {
			echo "글쓴이<input type='text' name='guest_username' placeholder='글쓴이' />
			비밀번호<input type='password' name='secret' placeholder='6자리 비밀번호' />
			";
			
			if ( $site_config['use_captcha'] ) {
				echo "<div>보안문자";
				if ( !$captcha_skin = $site_config['captcha_skin'] ) $captcha_skin = 'default';
				load_skin('captcha', $captcha_skin);
				echo "</div>";
			}
		}
		
		if ( !$comment_write_form_skin = $post_cfg['comment_write_form_skin'] ) $comment_write_form_skin = 'default';
		load_skin('comment_write_form', $comment_write_form_skin);
		?>
		<div id='comment-submit-button-group'>
			<input type='reset' value='취소' />
			<input type='submit' value='글쓰기' />
		<div style='clear:right;'></div>
		</div>
	</form>
</div>
