<?php
echo skin_css($so, __FILE__);
echo skin_javascript($so, __FILE__);
?>
<form id='member-policy-form'>
	<div id='member-policy'>
		<div id='first-row'>
			<h3>회원가입약관</h3>
			<textarea readonly><?=$site_config['terms_conds']?></textarea>
			<input type='checkbox' name='terms_conds_agree' value=1 />동의합니다.
		</div>
		<div>
			<h3>개인보호정책</h3>
			<textarea readonly><?=$site_config['policy']?></textarea>
			<input type='checkbox' name='policy_agree' value=1 />동의합니다.
		</div>
	</div>
	<input type='submit' value='동의합니다.' />
</form>