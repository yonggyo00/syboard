<?=skin_css($so, __FILE__)?>
<div id='secret-check-skin'>
	<div id='title'>비밀글 확인</div>
	<div id='sub-title'>글번호 <b><?=$in['seq']?></b>는 비밀번호가 설정 되어 있습니다. 게시글을 보실려면 비밀번호 6자리를 입력해 주세요.</div>
	<div id='post-password'>
		<div id='inner'>
			<span>비밀번호 입력</span><input type='password' name='post_secret' placeholder='6자리 비밀번호' />
		</div>
	</div>
</div>