<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<div id="write-form-skin">
<?php
	// 어드민 또는 게시판 어드민인 경우 공지를 나타낸다.
	if ( admin() || $sy['post']->admin() ) {
	?>
		<input type='checkbox' name='reminder' value=1 <?=$p['reminder']?'checked':''?> />공지
	<?}?>
<?php
	if ( $post_cfg['use_secret'] ) {?>
		<input type='checkbox' name='use_secret' value=1 <?=$p['use_secret']?'checked':''?> />비밀글
		
		<? if ( $p['use_secret'] ) {?>
			<style>
				#secret_password { display: inline !important; }
			</style>
		<?}?>
		<span id='secret_password'>비밀번호<input type='password' name='secret' placeholder='비밀번호 6자리를 입력하세요' /></span>
<?	}?>
<?php
	if ( $post_cfg['show_write_category'] ) {
		include_once MODEL_PATH . '/category.php';
				
		if ( !$write_category_skin = $post_cfg['write_category_skin'] ) $write_category_skin = 'default';
		load_skin('write_category', $write_category_skin);
	}
?>
	<div id="subject">
		<span class='title'>제목</span><input type='text' name='subject' value='<?=stripslashes($p['subject'])?>'/>
	</div>
	<?php 
		if ( empty($post_cfg['use_login_post']) && !$sy['mb']->is_login() ) {
			if ( $in['action'] == 'write' && !$sy['mb']->is_login() ) {?>
				글쓴이<input type='text' name='guest_username' placeholder='글쓴이' />
				글 비밀번호<input type='password' name='guest_secret' placeholder='6자리 비밀번호' />
			<?}
			if ( $site_config['use_captcha'] ) {
				echo "<div>보안문자";
				if ( !$captcha_skin = $site_config['captcha_skin'] ) $captcha_skin = 'default';
				load_skin('captcha', $captcha_skin);
				echo "</div>";
			}?>
		<?}?>
<?php
	if ( $post_cfg['blog_api_use'] ) {
		 for ( $i=1; $i<=3; $i++ ) {?>
			<div>
				블로그 계정<?=$i?> <input type='text' name='blog_category_<?=$i?>' value='<?=$p['blog_category_'.$i]?>' placeholder='블로그 카테고리<?=$i?>' />
				<input type='text' name='blog_tags_<?=$i?>' value='<?=$p['blog_tags_'.$i]?>' placeholder='블로그 태그<?=$i?>'/>
			</div>
		<?}?>
	<?}?>
	<?php
		$p['content'] = $sy['post']->escaped_textarea($p['content']);
	?>
	<textarea id='write-content' name='content'><?=$p['content']?></textarea>
</div>
<?php
if ((empty($post_cfg['use_editor']) && $in['action'] == 'write') || ($in['action'] == 'update' && empty($p['editor_used']) )) {?>
<style>
#write-form-skin #write-content {
	width: 100%;
	height: 350px;
	resize: none;
}
</style>
<?}?>
