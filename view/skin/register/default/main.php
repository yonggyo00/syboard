<?=skin_css($so, __FILE__)?>
<?php
if ( $so['mode'] == 'update' ) {
	$info = $sy['mb']->info($_member['seq'], "*");
	$password = lang('Register chaning password');
	$confirm_password = lang('Register confirm password');
	$action = 'update_submit';
	$submit = lang('Register update');
	$hidden_input = "<input type='hidden' name='seq' value='".$info['seq']."' />";
	$gid = $info['gid'];
	$notice = "<div id='notice'>".lang('Register notice')."</div>";
	$email = "<span class='sub-title'>".lang('Register email')."*</span> ".$info['email'];
	
	echo "
			<style>
				#member-register{
					display: block !important;
				}
			</style>
	";
}
else {
	if ( $site_config['use_terms_conds'] || $site_config['use_policy'] )  {
		include_once 'policy.php';
	}
	else {
		echo "
			<style>
				#member-register{
					display: block !important;
				}
			</style>
		";
	}
	
	$password = lang('Register password')."*";
	$confirm_password = lang('Register confirm password')."*";
	$action = 'register_submit';
	$submit = lang('Register register');
	$hidden_input = null;
	$gid = gid();
	$notice = null;
	
	if ( $site_config['use_register_auth'] ) {
		// 이메일 인증 회원가입인 경우 register_auth 테이블에서 이메일을 auth_key로 조회한다.
		
		$email = $sy['mb']->register_auth_email($in['auth_key']);
		
		$email = "<span class='sub-title'>".lang('Register email')."*</span> ".$email . "
					<input type='hidden' name='email' value='".$email."' />";
	}
	else $email = "<span class='sub-title'>".lang('Register email')."*</span> <input type='text' name='email' />";
}
ob_start();
echo "<div id='profile-uploader'>
		<div id='title'>".lang('Register profile photo')."</div>";
		load_skin('image_uploader', 'default', array('gid'=>$gid, 'code'=>'profile_photo', 'width'=>150, 'height'=>150));
echo "
		$notice
	</div>";
$proflie_uploader = ob_get_clean();
?>

<div id='member-register'>
	<? if ( $so['title'] ) {?>
		<div id='title'><?=$so['title']?> <span>* <?=lang('Register required')?></span>
			<div style='clear:right;'></div>
		</div>
	<? }?>
	<?=$proflie_uploader?>
	<form method='post' target='hiframe' autocomplete='off'>
		<input type='hidden' name='module' value='member' />
		<input type='hidden' name='action' value='<?=$action?>' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='header' value=1 />
		<input type='hidden' name='gid' value='<?=$gid?>' />
		<?=$hidden_input?>
		<div><span class='sub-title'><?=lang('Register username')?>*</span>
			<? if ( $so['mode'] == 'update') {?>
				<?=$info['username']?>
				<input type='hidden' name='username' value='<?=$info['username']?>' />
			<?} else {?>
				<input type='text' name='username' />
			<?}?>
		</div>
		
		<div><span class='sub-title'><?=$password?></span> <input type='password' name='password' /></div>
		<div><span class='sub-title'><?=$confirm_password?></span> <input type='password' name='confirm_password' /></div>
		<div><span class='sub-title'><?=lang('Register name')?>*</span> <input type='text' name='name' value='<?=$info['name']?>' /></div>
	
		<div><span class='sub-title'><?=lang('Register nickname')?>*</span> 
		<?php
			if ( $so['mode'] == 'update' && empty($site_config['permit_nickname_change']) ) {?>
			<?=$info['nickname']?>
		<?} else {?>
			<input type='text' name='nickname' value='<?=$info['nickname']?>' />
		<?}?>
		</div>
		<div><?=$email?></div>
		<div><span class='sub-title'><?=lang('Register mobile')?></span> <input type='text' name='mobile' value='<?=$info['mobile']?>' /></div>
		<div><span class='sub-title'><?=lang('Register landline')?></span> <input type='text' name='landline' value='<?=$info['landline']?>' /></div>
		<div>
			<span class='sub-title'><?=lang('Register region')?></span>
			<?php 
				$option = array();
				if ( $info['province'] ) $option['selected_province'] = $info['province'];
				if ( $info['city'] ) $option['selected_city'] = $info['city'];
				
				load_skin('location', 'philippines_location', $option);
			?>
		</div>
		<div><span class='sub-title'><?=lang('Register address')?></span> <input type='text' name='address' value='<?=$info['address']?>' /></div>
		<div><span class='sub-title'><?=lang('Register signature')?></span> <input type='text' name='signature' value='<?=$info['signature']?>' /></div>
		<div><span class='sub-title'><?=lang('Register introduction')?></span>
		<hr />
			<div id='introduction'><textarea rows=5 name='introduction'><?=$info['introduction']?></textarea></div>
		</div>
		
	<?php
		if ($site_config['use_capcha_in_register']) {
			echo "<span class='sub-title'>".lang('Register captcha')."</span>";
			if ( !$captcha_skin = $site_config['captcha_skin'] ) $captcha_skin = 'default';
			load_skin('captcha', $captcha_skin);
		}			
	?>
		
		<div>
			<input type='submit' value='<?=$submit?>' />
			<div style='clear:right;'></div>
		</div>		
	</form>
</div>