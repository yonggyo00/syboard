<form method='get' autocomplete='off'>
	<input type='hidden' name='module' value='sub_admin' />
	<input type='hidden' name='action' value='member' />
	<fieldset>
		<legend>검색 조건</legend>
		<div class='sub-admin-row'>
			<span class='sub-title'>아이디</span> <input type='text' name='username' value='<?=$in['username']?>' />
			<span class='sub-title'>이름</span> <input type='text' name='name' value='<?=$in['name']?>' />
		</div>
		<div class='sub-admin-row'>
			<span class='sub-title'>닉네임</span> <input type='text' name='nickname' value='<?=$in['nickname']?>' />
			<span class='sub-title'>이메일</span> <input type='text' name='email' value='<?=$in['email']?>' />
		</div>
		<div class='sub-admin-row'>
			<input type='checkbox' name='blocked_user' value=1 <?=$in['blocked_user']?"checked":""?> /> 차단된 회원
			<input type='checkbox' name='resign_user' value=1 <?=$in['resign_user']?"checked":""?> /> 탈퇴한 회원
		</div>
		<div class='sub-admin-row'>
			<span class='sub-title'>유선전화</span> <input type='text' name='landline' value='<?=$in['landline']?>' />
			<span class='sub-title'>휴대전화</span> <input type='text' name='mobile' value='<?=$in['mobile']?>' />
			<input type='submit' value='검색' />
		</div>
	</fieldset>
</form>