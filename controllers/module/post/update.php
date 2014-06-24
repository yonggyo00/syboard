<?php 
if ( !admin() && !$sy['post']->admin() && !site_admin()) { //어드민이거나, 게시판 어드민인 경우는 확인 하지 않는다.
	if ( $p['guest_secret'] ) { // 손님글의 경우 비밀번호를 확인 하고
		if ( $_SESSION['post_no_'.$p['seq'].'_guest_secret'] != $p['guest_secret'] ) {
			return $sy['js']->back("손님글에 설정된 비밀번호가 다릅니다.");
		}
	} else { // 아닌 경우는 본인의 글인지 확인을 한다.
		if ( !$sy['post']->my_post($p['seq_member']) ) return $sy['js']->back("본인 글이 아니면 수정할 수 없습니다.");
	}
}
include_once 'write.php';
?>