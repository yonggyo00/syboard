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
	
	// 게시판 제목 상단 콜백
	if ( function_exists('before_view_post_subject') ) {
			before_view_post_subject();
	}
	
	// 게시판 제목
	if ( !$view_post_subject_skin = $post_cfg['view_post_subject_skin'] ) $view_post_subject_skin = 'default';
	load_skin('view_post_subject', $view_post_subject_skin);
	
	// 게시판 제목 하단 콜백
	if ( function_exists('after_view_post_subject') ) {
			after_view_post_subject();
	}
	
	// 메뉴, 투표 상단 콜백
	if ( function_exists('before_view_menu_vote') ) {
			before_view_menu_vote();
	}
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
	// 메뉴, 투표 하단 콜백
	if ( function_exists('after_view_menu_vote') ) {
			after_view_menu_vote();
	}
	
	// 글 보기 제목 스킨
	if ( !$view_subject_skin = $post_cfg['view_subject_skin'] ) $view_subject_skin = 'default';
	load_skin ( 'view_subject', $view_subject_skin );
	
	// 글 제목 하단 콜백
	if ( function_exists('after_view_subject') ) {
			after_view_subject();
	}
	
	// 글 본문 상단 콜백
	if ( function_exists('before_view_content') ) {
			before_view_content();
	}
	
	// 글 보기 스킨
	if ( !$view_skin = $post_cfg['view_skin'] ) $view_skin = 'default';
	load_skin ( 'view', $view_skin );
	
	// 글 본문 하단 콜백
	if ( function_exists('after_view_content') ) {
			after_view_content();
	}
	
	// 지도 상단 콜백
	if ( function_exists('before_view_map') ) {
			before_view_map();
	}
	
	// 지도 보기 스킨
	if ( $post_cfg['map_use'] ) { // 지도 사용 선택 되었다면,
		if( !$map_skin = $post_cfg['map_skin'] ) $map_skin = 'default';
		load_skin('map', $map_skin, array('title'=>'지도'));
	}
	
	// 지도 하단 콜백
	if ( function_exists('after_view_map') ) {
			after_view_map();
	}
	
	// 댓글 폼 상단 콜백
	if ( function_exists('before_view_comment_form') ) {
			before_view_comment_form();
	}
	
	// 댓글 폼
	if ( $post_cfg['view_with_comment'] &&  ( $sy['mb']->is_login() || empty($post_cfg['use_login_post']))) {
		include_once 'comment.form.php';
	}
	
	// 댓글 폼 하단 콜백
	if ( function_exists('after_view_comment_form') ) {
			after_view_comment_form();
	}
	
	// 댓글 목록 상단 콜백
	if ( function_exists('before_view_comment_list') ) {
			before_view_comment_list();
	}
	
	if ( $post_cfg['view_with_comment_list'] ) {
		include_once 'comment.list.php';
	}
	
	// 댓글 목록 하단 콜백
	if ( function_exists('after_view_comment_list') ) {
			after_view_comment_list();
	}
	
	// 리스트 추가
	if ( $post_cfg['view_with_list'] ) include_once 'list.php';
}
else $sy['js']->back("글이 존재 하지 않습니다.");
?>