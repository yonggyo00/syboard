<?php
if ( !admin() && !$sy['post']->admin() && !site_admin() ) { //어드민이거나, 게시판 어드민인 경우는 확인 하지 않는다.
	if ( $p['guest_secret'] ) { // 손님글의 경우 비밀번호를 확인 하고
		if ( $_SESSION['post_no_'.$p['seq'].'_guest_secret'] != $p['guest_secret'] ) {
			return $sy['js']->back("손님글에 설정된 비밀번호가 다릅니다.");
		}
	} else { // 아닌 경우는 본인의 글인지 확인을 한다.
		if ( !$sy['post']->my_post($p['seq_member']) ) return $sy['js']->back("본인 글이 아니면 삭제 할 수 없습니다.");
	}
}

$result = $sy['post']->delete($in['seq']);
$msg = "삭제에 실패하였습니다.";
if ( $result ) {
	$msg = "삭제되었습니다.";
	
	if ( $sy['mb']->is_login() ) {
		$my_point = $sy['mb']->my_point();
		
		$update_points = $my_point - $post_cfg['point'];
		
		if ( $update_points < 0 ) $update_points = 0;
		
		$sy['db']->update(MEMBER_TABLE, array('point'=>$update_points), array('seq'=>$_member['seq']));
	}

	if ( $post_cfg['blog_api_use'] ) {
		
		$blog_apis = $sy['post']->blog_apis();

		for ( $i=1; $i <= 3; $i++ ) {
			if ( $p['blog_no_'.$i] ) $blog_no = $p['blog_no_'.$i];
			
			if ( $blog_apis['blog_api_url'.$i] && $blog_apis['blog_api_account'.$i] && $blog_apis['blog_api_password'.$i] ) {
				$blog_api = array(
											'api_end_point' => $blog_apis['blog_api_url'.$i], 
											'username' => $blog_apis['blog_api_account'.$i],
											'password' => $blog_apis['blog_api_password'.$i]
									);
			
				if ( $blog_api['api_end_point'] && $blog_api['username'] && $blog_api['password'] ) {
					$blog_url = $blog_api['api_end_point'];
					$user_id = $blog_api['username'];
					$blog_id = $blog_api['username'];
					$password = $blog_api['password'];
				}
				else return;
			
				$publish = true; //게시글 공개 여부 설정 
				
				
				$get_title = "삭제되었습니다.";
				$get_desc =	"삭제되었습니다.";
				
				if ( $p['blog_category_'.$i] ) $category = $p['blog_category_'.$i];
				else $category = null;
				
				if ( $p['blog_tags_'.$i] ) $tags = $p['blog_tags_'.$i];
				else $tags = null;
			
				$return = BlogPost($get_title, $get_desc, $category, $tags, $i);

				if ( $return ->faultCode() ) {
					$str = $return->faultString();
						
					echo $str;
				}
			} else continue;
		}
	}
}
$sy['js']->location($msg, $sy['post']->list_url($in['post_id']));
?>