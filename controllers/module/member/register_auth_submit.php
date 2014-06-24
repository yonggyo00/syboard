<?php
if ( !$sy['mb']->is_login() ) {
	// 이메일 체크
	if ( !@isValidEmail($in['email'], true) ) return $sy['js']->alert("이메일이 유효하지 않습니다.");
	
	if ( $sy['mb']->check_email($in['email']) ) return $sy['js']->alert("이미 가입한 이메일 입니다.");
	
	
	$is_register_auth_exists = 0;
	$auth_key = gid();
	
	// 회원가입 인증 시도가 있었는지 확인
	if ( $check_register_auth = $sy['mb']->check_register_auth($in['email']) ) {
		$is_register_auth_exists = 1;
		
		// 이미 이메일 인증을 시도한 회원 중에 아직 가입되지 않은 회원은 기존 register_auth 테이블에서 발급 받은 키를 가져온다.
		$auth_key = $check_register_auth;
	}
	
	// 가입 인증 주소
	$register_auth_confirm_url = $sy['mb']->register_auth_confirm_url($auth_key);
	
	echo $register_auth_confirm_url;

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
						가입 인증 주소가 발급 되었습니다.
					</h3>
					
					<div style="font-family:'맑은 고딕', AppleGothic; color='#313131'">아래의 주소를 클릭 하여 회원 가입 인증을 해 주세요.</div>
					<div><a href='<?=$register_auth_confirm_url?>'>http:<?=$register_auth_confirm_url?></a></div>
					<br />
					<br />
					<div style='color: #6c573c; font-size: 8.7pt; font-style:italic;'>이 메일은 발신전용으로 전송되었습니다. 발신 메일로 답장을 보내셔도 수신할 수 없습니다.</div>
				</div>
			</body>
		</html>
<?php		
	$content = ob_get_clean();
	$domain = domain("//".$_SERVER['HTTP_HOST']);
	$mail_domain = $domain[2].$domain[3];
	
	if ( $domain[1] && $domain[1] != 'www' ) $mail_domain = $domain[1].".".$mail_domain;
		
	$option = array(
					'to'=>array($in['email']),
					'subject'=>$subject,
					'content'=> $content,
					'from'=> $site_config['title'] . ' <no-reply@'.$mail_domain.'>'
	);
	
	$is_sent = 0;
	if ( mailer($option) ) {
	
		if ( !$is_register_auth_exists ) { // 기존에 인증 시도를 하지 않은 경우
			// 이메일을 성공적으로 보냈을 경우 register_auth 테이블에 이메일과 인증 키 값을 저장한다. 
			$op = array(
							'email'=>$in['email'],
							'auth_key'=>$auth_key
			);
			
			$sy['mb']->insert_register_auth($op);
		}
		
		$is_sent = 1;
	}
?>
	<script>
		$(document).ready(function() {
			parent.register_auth_email_sent("<?=$in['email']?>", '<?=$is_sent?>' );
		});
	</script>
<?}?>