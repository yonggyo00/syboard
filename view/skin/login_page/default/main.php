<?=skin_css($so, __FILE__)?>
<a name='login_box'></a>
<div id="login-page-skin">
	<span id='title'><?=$so['title']?></span>
	<div id='login-page-top'>
		<a href='<?=$register_url?>'><?=lang("Login Register")?></a>
		<a href='?module=member&action=find_username_password'><?=lang("Login Find username password")?></a>
		<div style='clear:left;'></div>
	</div>	
	<table cellpadding=0 cellspacing=0 border=0>
		<tr>
			<td><div class='sub-title'><?=lang('Login username')?></div></td>
			<td width=5></td>
			<td><div class='sub-title'><?=lang('Login password')?></div></td>
		</tr>
		<tr>
			<td>
				<input type='text' name='username' placeholder="<?=lang('Login username')?>" />
			</td>
			<td width=5></td>
			<td>
				<input type='password' name='password' placeholder="<?=lang('Login password')?>" />
			</td>
		</tr>
	</table>
	<div id='login-page-bottom'>
		<span id='auto-login'>
			<input type='checkbox' name='auto_login' value=1 /><?=lang("Login autologin")?>
		</span>
		<span id='ip-sec-login' style='float: right;'>
			<input type='checkbox' name='ip_sec' value=1 checked /><?=lang('Login ip_sec')?>
		</span>
		<div style='clear:both;'></div>
	</div>
	<div>
		<input type='submit' value='<?=lang("Login Login")?>' />
	</div>
</div>