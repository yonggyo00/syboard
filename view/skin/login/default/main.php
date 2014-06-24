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
		
	?>
		<input type='hidden' name='action' value='logout' />
		
		<div id='profile-image'><?=$profile_image?></div>
		<div id='pannel1'>
			<div id='username'><?=stringcut($_member['nickname'], 15)?><?=lang("Login username")?></div>
			<div><a href='?module=member&action=update'><?=lang("Login edit profile")?></a></div>
			<div>
				<a href='<?=$sy['ms']->list_url()?>'><?=lang("Login Message")?><?=$new?></a> &nbsp;&nbsp;
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
			
		<?php
			if ( admin() ) {
				echo "<a href='?module=admin&action=index&layout=1' target='_blank'>".lang("Login Site Panel")."</a>";
			}
		?>
		&nbsp;<a href='?module=member&action=resign'><?=lang("Login Resign")?></a>
	
		<? if ( !admin() ) {?>
			&nbsp;&nbsp;
			<a href='?module=post&action=my_posts'/>나의글</a>&nbsp;
			<a href='?module=post&action=my_comments'/>내의댓글</a>
		<? }?>
		<?if ( site_admin() ) {?>
			&nbsp;<a id='site-admin' href='?module=sub_admin&action=index'>관리</a>
		<?}?>
		
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
		<div id='username'><?=$user_img?><input type='text' name='username' placeholder="아이디" /></div>
		<div id='password'><?=$pass_img?><input type='password' name='password' placeholder="비밀번호" /></div>
		<div style='margin-top: 5px;'>
			<span id='auto-login'><input type='checkbox' name='auto_login' value=1 /><?=lang("Login autologin")?></span>
			<input type='submit' value='<?=lang("Login Login")?>' />
			<div style='clear:right;'></div>
		</div>
	<? }?>
	</form>
</div>