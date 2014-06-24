<form class='margin-bottom' method='get' autocomplete='off'>
	<input type='hidden' name='module' value='admin' />
	<input type='hidden' name='action' value='index' />
	<input type='hidden' name='option' value='member' />
	<input type='hidden' name='layout' value=1 />
	<div class='admin-sub-title'>검색 조건</div>
		<div class='admin-row'>
			<span class='sub-title'>도메인</span> <input type='text' name='domain' value='<?=$in['domain']?>' />
			<span class='sub-title'>아이디</span> <input type='text' name='username' value='<?=$in['username']?>' />
		</div>
		<div class='admin-row'>
			<span class='sub-title'>이름</span> <input type='text' name='name' value='<?=$in['name']?>' />
			<span class='sub-title'>닉네임</span> <input type='text' name='nickname' value='<?=$in['nickname']?>' />
		</div>
		<div class='admin-row'>
			<span class='sub-title'>이메일</span> <input type='text' name='email' value='<?=$in['email']?>' />
			<input type='checkbox' name='blocked_user' value=1 <?=$in['blocked_user']?"checked":""?> /> 차단된 회원
			<input type='checkbox' name='resign_user' value=1 <?=$in['resign_user']?"checked":""?> /> 탈퇴한 회원
		</div>
		<div class='admin-row'>
			<span class='sub-title'>유선전화</span> <input type='text' name='landline' value='<?=$in['landline']?>' />
			<span class='sub-title'>휴대전화</span> <input type='text' name='mobile' value='<?=$in['mobile']?>' />
			
		</div>
		<input type='submit' value='검색' />
</form>