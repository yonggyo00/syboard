<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
$register_url = $sy['mb']->register_url();
?>
<div id="login_skin">
	<form id="login-form" method='post' target='hiframe' autocomplete='off'>
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='header' value=1 />
		<input type='hidden' name='module' value='member' />
	<?if ( $sy['mb']->is_login() ) {
		if ( $new = number_format($sy['ms']->no_of_unreaded()) ) {
			$new = "(".$new.")";
		} else $new = null;

        // 프로필 이미지
		if ( $image_url = $sy['mb']->profile_photo($_member['gid'], 52, 52) ) {
			$profile_image  = "<img src='$image_url' />";
		}
		else $profile_image = "<img src='".$so['path']."/img/profile.png' />";
		
		// ip보안 로그인인 경우
		if ( $_member['use_ip_sec'] ) $ip_sec_icon = "<img id='ip-sec-icon' src='".$so['path']."/img/ip_sec_on.png' align='center'/>";
		else $ip_sec_icon = "<img id='ip-sec-icon' src='".$so['path']."/img/ip_sec_off.png' align='center' />";
	?>
		<input type='hidden' name='action' value='logout' />
		
		<div id='profile-image'><?=$profile_image?></div>
		<div id='pannel1'>
			<div id='username'><?=stringcut($_member['nickname'], 15)?><?=lang("Login msg")?></div>
			<div>
				<a href='?module=member&action=update'><?=lang("Login edit profile")?></a>
				<?=$ip_sec_icon?>
			</div>
			<div>
				<span popup_url= '<?=$sy['ms']->list_url()?>' id='message-popup'><?=lang("Login Message")?><?=$new?></span>&nbsp;&nbsp;
				<a href='?module=post&action=my_scrap'><?=lang("Login Scrap")?></a>
			</div>
			<div>
				<?php 
					$point = $sy['mb']->my_point(); 
				    $level = $sy['mb']->level($point);
				?>
				<span id='point'><?=lang("Login Point")?> <?=number_format($point)?></span>
				<span id='level'><?=lang("Login Level")?> <?=$level?></span>
			</div>
		</div>
		<div style='clear:left;'></div>
			
		
		&nbsp;<a href='?module=member&action=resign'><?=lang("Login Resign")?></a>
	
			&nbsp;&nbsp;
			<a href='?module=post&action=my_posts'/><?=lang('Login My Post')?></a>&nbsp;
			<a href='?module=post&action=my_comments'/><?=lang('Login My Comment')?></a>
		
		<div>
			<?php
				if ( admin() ) {
					echo "<a href='?module=admin&action=index&layout=1' target='_blank'>".lang("Login Site Panel")."</a>";
				}
			?>
			
			<?php
				if ( site_admin() ) {?>
					<a id='site-admin' href='?module=sub_admin&action=index'><?=lang('Login Site Panel')?></a>
			<?}
				// 보안레벨종류 가져오기
				$_levels = $sy['mb']->ip_security_levels();
			?>
			&nbsp;<span popup_url='?module=member&action=ip_sec_level&layout=1' id='ip-sec-layer_popup'><?=lang('Login ip_sec_level')?>(<?=$_levels[$_member['ip_sec_level']]?>)</span>
		</div>
		<div id='logout-button'><input type='submit' value='<?=lang("Login Logout")?>' /></div>
		<div style='clear:right;'></div>
	<? } else {
			$pass_img = "<img src='".$so['path']."/img/lock.png' align='center'/>";
			$user_img = "<img src='".$so['path']."/img/user.png' align='center'/>";
	?>
		<div id='login-skin-top'>
			<a href='<?=$register_url?>'><?=lang("Login Register")?></a>
			<a style='float: right;' href='?module=member&action=find_username_password'><?=lang("Login Find username password")?></a>
			<div style='clear:right;'></div>
		</div>
		
		<input type='hidden' name='action' value='login' />
		<div id='username'><?=$user_img?><input type='text' name='username' placeholder="<?=lang('Login username')?>" /></div>
		<div id='password'><?=$pass_img?><input type='password' name='password' placeholder="<?=lang('Login password')?>" /></div>
		<div style='margin-top: 5px;'>
			<div id='login-bottom-left'>
				<div id='auto-login'><input type='checkbox' name='auto_login' value=1 /><?=lang("Login autologin")?></div>
				<div id='ip-sec'><input type='checkbox' name='ip_sec' value=1 checked /><?=lang('Login ip_sec')?></div>
			</div>
			<input id='login-button' type='submit' value='<?=lang("Login Login")?>' />
			<div style='clear:right;'></div>
		</div>
	<? }?>
	</form>
</div>