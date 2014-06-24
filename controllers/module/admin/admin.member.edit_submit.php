<?php
if ( empty($in['seq']) ) return $sy['js']->alert("잘못된 접근 입니다.");

if ( $in['mode'] == 'unblock' ) {
	$sy['db']->delete(BLOCK_TABLE, array('seq_member'=>$in['seq']));
	
	if ( $sy['db']->update(MEMBER_TABLE, array('block_stamp'=>0), array('seq'=>$in['seq'])) ) {
		
		echo "
				<script>
					alert('차단이 해제되었습니다.');
					parent.location.reload();
				</script>
		";
		
	}
	
}
else if ( $in['mode'] == 'unresign' ) {
	if ( $sy['db']->update(MEMBER_TABLE, array('resign_stamp'=>0), array('seq'=>$in['seq'])) ) {
		
		echo "
				<script>
					alert('활성화 되었습니다.');
					parent.location.reload();
				</script>
		";
		
	}
}
else if ( $in['mode'] == 'block' ) {
	$option = array(
					'seq_member'=>$in['seq'],
					'ip'=>ip_2_long($_SERVER['REMOTE_ADDR'])
	);
	
	if ( $sy['db']->insert(BLOCK_TABLE, $option) ) {
	
		if ( $sy['db']->update(MEMBER_TABLE, array('block_stamp'=>time()), array('seq'=>$in['seq'])) ) {
			
			echo "
					<script>
						alert('차단되었습니다.');
						parent.location.reload();
					</script>
			";
			
		}
	}
}
else if ( $in['mode'] == 'resign' ) {
	if ( $sy['db']->update(MEMBER_TABLE, array('resign_stamp'=>time()), array('seq'=>$in['seq'])) ) {
		
		echo "
				<script>
					alert('탈퇴 처리 되었습니다.');
					parent.location.reload();
				</script>
		";
		
	}
}
else {
	$option = array(
					'domain'=>$in['domain'],
					'name'=>$in['name'],
					'nickname'=>$in['nickname'],
					'email'=>$in['email'],
					'mobile'=>$in['mobile'],
					'landline'=>$in['landline'],
					'address'=>$in['address'],
					'signature'=>$in['signature'],
					'introduction'=>$in['introduction'],
					'point'=>$in['point'],
					'is_admin'=>$in['is_admin']
	);

	if ( $in['password'] ) {
		if ( empty($in['confirm_password']) ) return $sy['js']->alert("비밀번호 확인을 해 주세요."); 
		
		if ( $in['password'] != $in['confirm_password'] ) return $sy['js']->alert("비밀번호를 정확하게 입력하세요.");
		
		$option['password'] = md5($in['password']);
	}

	if ( $sy['db']->update(MEMBER_TABLE, $option, array('seq'=>$in['seq'])) ) {
		echo "
			<script>
				alert('수정되었습니다.');
				parent.location.reload();
			</script>";
	}
}
?>