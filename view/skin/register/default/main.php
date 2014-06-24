<?=skin_css($so, __FILE__)?>
<?php
if ( $so['mode'] == 'update' ) {
	$info = $sy['mb']->info($_member['seq'], "*");
	$password = "비밀번호 변경";
	$confirm_password = "비밀번호 확인";
	$action = 'update_submit';
	$submit = "수정하기";
	$hidden_input = "<input type='hidden' name='seq' value='".$info['seq']."' />";
	$gid = $info['gid'];
	$notice = "<div id='notice'>반드시 수정하기 버튼을 클릭해서 완료 하셔야 사진이 반영이 됩니다.</div>";
	$email = "<span class='sub-title'>이메일*</span> ".$info['email'];
}
else {
	if ( $site_config['use_terms_conds'] || $site_config['use_policy'] )  {
		include_once 'policy.php';
	}
	$password = "비밀번호*";
	$confirm_password = "비밀번호 확인*";
	$action = 'register_submit';
	$submit = "가입하기";
	$hidden_input = null;
	$gid = gid();
	$notice = null;
	
	if ( $site_config['use_register_auth'] ) {
		// 이메일 인증 회원가입인 경우 register_auth 테이블에서 이메일을 auth_key로 조회한다.
		
		$email = $sy['mb']->register_auth_email($in['auth_key']);
		
		$email = "<span class='sub-title'>이메일*</span> ".$email . "
					<input type='hidden' name='email' value='".$email."' />";
	}
	else $email = "<span class='sub-title'>이메일*</span> <input type='text' name='email' />";
}
ob_start();
echo "<div id='profile-uploader'>
		<div id='title'>프로필 사진</div>";
load_skin('image_uploader', 'default', array('gid'=>$gid, 'code'=>'profile_photo', 'width'=>150, 'height'=>150));
echo "
		$notice
	</div>";
$proflie_uploader = ob_get_clean();
?>

<div id='member-register'>
	<? if ( $so['title'] ) {?>
		<div id='title'><?=$so['title']?> <span>* 필수기입 정보</span>
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
		<div><span class='sub-title'>아이디*</span>
			<? if ( $so['mode'] == 'update') {?>
				<?=$info['username']?>
				<input type='hidden' name='username' value='<?=$info['username']?>' />
			<?} else {?>
				<input type='text' name='username' />
			<?}?>
		</div>
		
		<div><span class='sub-title'><?=$password?></span> <input type='password' name='password' /></div>
		<div><span class='sub-title'><?=$confirm_password?></span> <input type='password' name='confirm_password' /></div>
		<div><span class='sub-title'>이름*</span> <input type='text' name='name' value='<?=$info['name']?>' /></div>
	
		<div><span class='sub-title'>닉네임*</span> 
		<?php
			if ( $so['mode'] == 'update' && empty($site_config['permit_nickname_change']) ) {?>
			<?=$info['nickname']?>
		<?} else {?>
			<input type='text' name='nickname' value='<?=$info['nickname']?>' />
		<?}?>
		</div>
		<div><?=$email?></div>
		<div><span class='sub-title'>휴대전화</span> <input type='text' name='mobile' value='<?=$info['mobile']?>' /></div>
		<div><span class='sub-title'>유선전화</span> <input type='text' name='landline' value='<?=$info['landline']?>' /></div>
		<div>
			<span class='sub-title'>지역</span>
			<?php 
				$option = array();
				if ( $info['province'] ) $option['selected_province'] = $info['province'];
				if ( $info['city'] ) $option['selected_city'] = $info['city'];
				
				load_skin('location', 'philippines_location', $option);
			?>
		</div>
		<div><span class='sub-title'>주소</span> <input type='text' name='address' value='<?=$info['address']?>' /></div>
		<div><span class='sub-title'>서명</span> <input type='text' name='signature' value='<?=$info['signature']?>' /></div>
		<div><span class='sub-title'>자기소개</span>
		<hr />
			<div id='introduction'><textarea rows=5 name='introduction'><?=$info['introduction']?></textarea></div>
		</div>
		
	<?php
		if ($site_config['use_capcha_in_register']) {
			echo "<span class='sub-title'>보안문자</span>";
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