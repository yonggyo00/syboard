<?php
/* $_member 배열에 use_ip_sec과 ip_sec_level을 추가한다.
* 따로 이런 방식으로 저장하는 것은 쿠키나, 세션에 저장한다면, 아 정보 역시 탈취가 가능하므로,
* IP 보안의 의미가 없어진다.
*/

$_ip_sec_row = $sy['db']->row("SELECT use_ip_sec, ip_sec_level FROM ". MEMBER_TABLE . " WHERE `seq`='".$_member['seq']."'");

if ( $_ip_sec_row ) {
	$_member['use_ip_sec'] = $_ip_sec_row['use_ip_sec'];
	$_member['ip_sec_level'] = $_ip_sec_row['ip_sec_level'];
}

// IP 보안 옵션이 체크된 상태라면,
if ( $_member['use_ip_sec'] ) {
	/*
	* 보안레벨에 따라 아이피를 체크한다.
	* 보안 레벨 0 - 아이피 4자리중 A클라스까지 체크
	* 보안 레벨 1 - B클라스까지 체크 
	* 보안 레벨 2 - C클라스까지 체크
	* 보안 레벨 3 - 정확한 아이피를 체크 한다.
	*/
	
	// 로그인시 ip_security 테이블에 저장된 IP
	$_ip_sec_ip = long_2_ip($sy['mb']->ip_sec_ip($_member['seq']));
	$_isi = array();
	$_isi = explode(".",$_ip_sec_ip);
	
	// 현재 접속한 Ip
	$_cui = explode(".", $_SERVER['REMOTE_ADDR']);
	
	
	$_ip_sec_check = 0;
	
	// 보안 레벨에 따른 체크
	for ( $i = 0; $i <= $_member['ip_sec_level']; $i++ ) {
		if ( $_isi[$i] != $_cui[$i] ) {
			$_ip_sec_check = 1;
			break;
		}
	}
	
	if ( $_ip_sec_check ) { 
		// $_ip_sec_check 값이 1이라면 부정 로그인(쿠키 탈취에 의한 로그인)이므로 로그아웃 시킨다.
		$sy['mb']->logout();
		$sy['js']->location(lang('Login error4'), site_url() );
	}
}
?>