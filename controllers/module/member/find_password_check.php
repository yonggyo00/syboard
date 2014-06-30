<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location("로그인한 후에는 아이디/비밀번호 찾기를 하실 수 없습니다.", site_url());

if ( $in['username'] && $in['email'] ) {
	// 이메일이 전송이 가능한 이메일 주소인지 유효성 및 DNS 검사를 한다.
	if ( !isValidEmail($in['email'], true) ) return $sy['js']->back("유효하지 않은 이메일 주소 입니다.");
	
	if ( $row = $sy['mb']->validate_username($in['username'], $in['email']) ) {
		
		/* 존재한다면, 비밀번호를 랜덤 숫자 8개로 생성한 후 새 비밀번호를
		 * 회원에게 보낸다. 메일이 성공적으로 보내지면 실제 비밀번호를 업데이트 한다.
		*/
		
		$new_password = rand ( 10000000 , 99999999 );
		
		$subject = "[발신전용]회원님에게 새로운 비밀번호가 발급 되었습니다.";
		
		ob_start();
?>		
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset='UTF-8' />
			</head>
			<body>
				<div style='border:1px solid #666666; padding: 10px; border-radius:3px; text-align: center;'>
					<h3 style="font-family:'맑은 고딕', AppleGothic;" color='#2e4855'>
						회원님에게 새로운 비밀번호가 발급 되었습니다. 
					</h3>
					
					<div style="font-family:'맑은 고딕', AppleGothic; color='#313131'">새로운 비밀번호는 <b style='color:orange;'><?=$new_password?></b> 입니다.<br />로그인 하신 후 회원정보변경에서 원하시는 비밀번호로 변경하세요.</div>
					
					<br />
					<br />
					<div style='color: #6c573c; font-size: 8.7pt; font-style:italic;'>이 메일은 발신전용으로 전송되었습니다. 해당메일로 답장을 보내셔도 수신할 수 없습니다.</div>
				</div>
			</body>
		</html>
<?php		
		$content = ob_get_clean();
		$domain = domain("//".$_SERVER['HTTP_HOST']);
		$mail_domain = $domain[2].$domain[3];
		
		if ( $domain[1] && $domain[1] != 'www' ) $mail_domain = $domain[1].".".$mail_domain;
		echo $mail_domain;
		$option = array(
						'to'=>array($row['name'] . " <".$in['email'].">"),
						'subject'=>$subject,
						'content'=> $content,
						'from'=> $site_config['title'] . ' <noreply@'.$mail_domain.'>'
		);
		
		
		if ( mailer($option) ) {
			$msg = "새로운 비밀번호가 회원님께서 가입시 등록한 이메일로 전송되었습니다.";
			// 메일이 성공적으로 보내졌다면, 실제 회원의 가입 비밀번호를 랜덤으로 생성된 새 비밀번호로 변경합니다.
			$sy['db']->update(MEMBER_TABLE, array('password'=>md5($new_password)), array('seq'=>$row['seq']));
			
		}
		else $msg = "새로운 비밀번호를 가입시 등록한 메일로 전송하지 못하였습니다.";
		
		$sy['js']->location($msg, "?");
		
	} else echo $sy['js']->back("등록하신 아이디또는 이메일이 정확하지 않습니다.");
	
}else $sy['js']->back("아이디와 가입시 등록한 이메일을 모두 입력하세요.");
?>