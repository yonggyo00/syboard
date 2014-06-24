<?php
echo module_css(__FILE__);
echo module_javascript(__FILE__);
if ( $p ) {	
	// 레벨 확인
	$point = $sy['mb']->my_point();
	if ( $sy['mb']->level($point) < $post_cfg['view_level'] ) return $sy['js']->back("레벨이 부족하여 글을 볼 수 없습니다.");
	
	// 비밀글인 경우 비밀번호 확인, 자기가 쓴 글인 경우 비밀번호 확인을 하지 않는다.
	if ( $p['secret'] && !$sy['post']->my_post($p['seq_member']) && !admin() && !$sy['post']->admin() ) {
		if ( $_SESSION['post_no_'.$p['seq'].'_secret'] != $p['secret'] ) {
			return $sy['js']->back("비밀글에 설정된 비밀번호가 다릅니다.");
		}
	}
	
	// 게시판 제목
	if ( !$view_post_subject_skin = $post_cfg['view_post_subject_skin'] ) $view_post_subject_skin = 'default';
	load_skin('view_post_subject', $view_post_subject_skin);
?>
	<table cellpadding=0 cellspacing=0 width='100%'>
		<tr valign='top'>
			<td width='50%' align='left'>
				<?php
					// 글 보기 메뉴  스킨
					if ( !$view_menu_skin = $post_cfg['view_menu_skin'] ) $view_menu_skin = 'default';
					load_skin ( 'view_menu', $view_menu_skin );
				?>
			</td>
			<td width='50%' align='right'>
				<?php
					if ( $post_cfg['use_view_vote'] ) {
						include_once 'vote.php';
					}
				?>
			</td>
		</tr>
	</table>
	<?php
	// 글 보기 제목 스킨
	if ( !$view_subject_skin = $post_cfg['view_subject_skin'] ) $view_subject_skin = 'default';
	load_skin ( 'view_subject', $view_subject_skin );
	
	
	// 글 보기 스킨
	if ( !$view_skin = $post_cfg['view_skin'] ) $view_skin = 'default';
	load_skin ( 'view', $view_skin );
	
	
	// 지도 보기 스킨
	if ( $post_cfg['map_use'] ) { // 지도 사용 선택 되었다면,
		if( !$map_skin = $post_cfg['map_skin'] ) $map_skin = 'default';
		load_skin('map', $map_skin, array('title'=>'지도'));
	}
	
	// 댓글 폼
	if ( $post_cfg['view_with_comment'] &&  ( $sy['mb']->is_login() || empty($post_cfg['use_login_post']))) {
		include_once 'comment.form.php';
	}
	
	if ( $post_cfg['view_with_comment_list'] ) {
		include_once 'comment.list.php';
	}
	
	// 리스트 추가
	if ( $post_cfg['view_with_list'] ) include_once 'list.php';
}
else $sy['js']->back("글이 존재 하지 않습니다.");
?>