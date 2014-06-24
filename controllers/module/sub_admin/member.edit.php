<?php
if ( empty($in['seq']) )  return $sy['js']->back("잘못된 접근 입니다.");

$info = $sy['mb']->info($in['seq'], '*');
?>
			<div><span class='sub-title'>번호</span><?=number_format($info['seq'])?></div>
			<div><span class='sub-title'>가입일</span><?=date('Y-m-d H:i:s', $info['reg_stamp'])?></div>
			<div><span class='sub-title'>가입IP</span><?=long_2_ip($info['ip'])?></div>
			<div><span class='sub-title'>아이디</span><?=$info['username']?></div>
	<?php		
		if ( $info['block_stamp'] ) {  // 차단된 회원인 경우?>	
			<div>
				<b>차단된 회원입니다.</b> 차단일 <?=date('Y-m-d H:i:s', $info['block_stamp'])?>
				<form method='post' target='hiframe'>
					<input type='hidden' name='module' value='sub_admin' />
					<input type='hidden' name='action' value='member.edit_submit' />
					<input type='hidden' name='layout' value=1 />
					<input type='hidden' name='seq' value='<?=$info['seq']?>' />
					<input type='hidden' name='mode' value='unblock' />
					<input type='submit' value='차단 해제' />
				</form>
			</div>
	<? }
		else {?>
			<div>
				<form method='post' target='hiframe'>
					<input type='hidden' name='module' value='sub_admin' />
					<input type='hidden' name='action' value='member.edit_submit' />
					<input type='hidden' name='layout' value=1 />
					<input type='hidden' name='seq' value='<?=$info['seq']?>' />
					<input type='hidden' name='mode' value='block' />
					<input type='submit' value='차단 하기' />
				</form>
			</div>	
	<?}?>
	
	<?php		
		if ( $info['resign_stamp'] ) {  // 차단된 회원인 경우?>	
			<div>
				<b>탈퇴한 회원입니다.</b> 탈퇴일 <?=date('Y-m-d H:i:s', $info['resign_stamp'])?>
				<form method='post' target='hiframe'>
					<input type='hidden' name='module' value='sub_admin' />
					<input type='hidden' name='action' value='member.edit_submit' />
					<input type='hidden' name='layout' value=1 />
					<input type='hidden' name='seq' value='<?=$info['seq']?>' />
					<input type='hidden' name='mode' value='unresign' />
					<input type='submit' value='활성화' />
				</form>
			</div>
	<? } else {?>
			<div>
				<form method='post' target='hiframe'>
						<input type='hidden' name='module' value='sub_admin' />
						<input type='hidden' name='action' value='member.edit_submit' />
						<input type='hidden' name='layout' value=1 />
						<input type='hidden' name='seq' value='<?=$info['seq']?>' />
						<input type='hidden' name='mode' value='resign' />
						<input type='submit' value='탈퇴시키기' />
				</form>
			</div>
	<? }?>
		<form method='post' target='hiframe' autocomplete='off'>
			<input type='hidden' name='module' value='sub_admin' />
			<input type='hidden' name='action' value='member.edit_submit' />
			<input type='hidden' name='layout' value=1 />
			<input type='hidden' name='seq' value='<?=$info['seq']?>' />
				<div>
					<span class='sub-title'>이름</span>
					<input type='text' name='name' value='<?=$info['name']?>' />
				</div>
				<div>
					<span class='sub-title'>닉네임</span>
					<input type='text' name='nickname' value='<?=$info['nickname']?>' />
				</div>
				
				<div class='hiborder'>
					<div>
						<span class='sub-title'>비밀번호변경</span>
						<input type='password' name='password' />
					</div>
					
					<div>
						<span class='sub-title'>비밀번호확인</span>
						<input type='password' name='confirm_password' />
					</div>
				</div>
				
				<div>
					<span class='sub-title'>이메일</span>
					<input type='text' name='email' value='<?=$info['email']?>' />
				</div>
				<div>
					<span class='sub-title'>휴대전화</span>
					<input type='text' name='mobile' value='<?=$info['mobile']?>' />
				</div>
				<div>
					<span class='sub-title'>유선전화</span>
					<input type='text' name='landline' value='<?=$info['landline']?>' />
				</div>
				<div>
					<span class='sub-title'>주소</span>
					<input type='text' name='address' value='<?=$info['address']?>' />
				</div>
				<div>
					<span class='sub-title'>서명</span>
					<input type='text' name='signature' value='<?=$info['signature']?>' />
				</div>
				<div>
					<span class='sub-title'>자기소개</span>
					<textarea name='introduction'><?=$info['introduction']?></textarea>
				</div>
				
				<div>
					<span class='sub-title'>포인트</span>
					<input type='text' name='point' value='<?=$info['point']?>' />
				</div>
				
				<input type='submit' value='수정하기' />
		</form>