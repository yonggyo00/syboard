<?=skin_css($so, __FILE__)?>
<div id='secret-check-skin'>
	<div id='title'>손님글 확인</div>
	<div id='sub-title'>글번호 <b><?=$in['seq']?></b>는 손님글로 작성되었습니다. 게시글을 보실려면 글 비밀번호 6자리를 입력해 주세요.</div>
	<div id='post-password'>
		<div id='inner'>
			<span>글 비밀번호 입력</span><input type='password' name='guest_secret' placeholder='6자리 비밀번호' />
		</div>
	</div>
</div>