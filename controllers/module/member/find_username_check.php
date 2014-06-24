<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location("로그인한 후에는 아이디/비밀번호 찾기를 하실 수 없습니다.", site_url());

if ( $in['name'] && $in['email'] ) {
	echo "<div id='find-username-check'>";
		if ( $username = $sy['mb']->find_username($in['name'], $in['email']) ) {
			echo "
				<div id='user-info'>
					회원님의 아이디는 <b>".$username."</b>입니다.
					
					<a href='".$sy['mb']->login_url()."'>로그인 하기</a>
				</div>
			";
		}
		else {
			echo "입력하신 회원정보가 정확하지 않습니다.";
		}
	echo "</div>";
}
else $sy['js']->back("가입시 이름과, 가입시 등록한 이메일을 모두 입력하세요.");
?>