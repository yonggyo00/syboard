<?php 
if ( $in['post_id'] ) {
	$point = $sy['mb']->my_point();
	if ( $sy['mb']->level($point) < $post_cfg['list_level'] ) return $sy['js']->back(lang('List error1'));
	
	include_once 'paging.top.php';
	
	if ( $in['action'] != 'view' ) { 
		// 제목 상단 콜백
		if ( function_exists('before_list_subject') ) {
			before_list_subject();
		}
		
		if ( !$list_subject_skin = $post_cfg['list_subject_skin'] ) $list_subject_skin = 'default';
		load_skin('list_subject', $list_subject_skin);

		// 제목 하단 콜백
		if ( function_exists('after_list_subject') ) {
			after_list_subject();
		}
	
		// 메뉴 상단 콜백	
		if ( function_exists('before_list_menu') ) {
			before_list_menu();
		}
		
		if ( !$post_list_menu_skin = $post_cfg['post_list_menu_skin'] ) $post_list_menu_skin = 'default';
		load_skin('post_list_menu', $post_list_menu_skin);

		// 메뉴 하단 콜백
		if ( function_exists('after_list_menu') ) {
			after_list_menu();
		}
	}
	// 공지 상단  콜백
	if ( function_exists('before_list_reminder') ) {
		before_list_reminder();
	}
	
	include_once MODEL_PATH .'/reminder.php';
	
	if ( !$post_list_reminder_skin = $post_cfg['post_list_reminder_skin'] ) $post_list_reminder_skin = 'default';
	load_skin('post_list_reminder', $post_list_reminder_skin, array('reminder'=> $reminders));
	
	// 공지 하단 콜백
	if ( function_exists('after_list_reminder') ) {
		after_list_reminder();
	}
	
	//카테고리 상단 콜백
	if ( function_exists('before_list_category') ) {
		before_list_category();
	}
	
	if ( $post_cfg['show_list_category'] ) {
		include_once MODEL_PATH . '/category.php';
		
		if ( !$list_category_skin = $post_cfg['list_category_skin'] ) $list_category_skin = 'default';
		load_skin('list_category', $list_category_skin);
	}
	
	// 카테고리 하단 콜백
	if ( function_exists('after_list_category') ) {
		after_list_category();
	}

	// 리스트 상단 콜백
	if ( function_exists('before_list') ) {
		before_list();
	}
	
?>
<form method='post' id='list-module-form' autocomplete='off'>
	<input type='hidden' name='module' value='post' />
	<input type='hidden' name='action' value='move' />
<?php	
	// 리스트 스킨
	if ( !$_skinname = $post_cfg['post_list_skin'] ) $_skinname = 'default';
	load_skin('post_list', $_skinname, array('total_post' => $total_post));
	
	if ( admin() || $sy['post']->admin() ) {
		// 게시물 이동
		include_once 'move_post_id_sel.php';
	}
?>	
</form>
<?php	
	// 리스트 하단 검색 폼
	if ( $post_cfg['use_post_list_search_form'] ) {
		if ( !$post_list_search_form_skin = $post_cfg['post_list_search_form_skin'] ) $post_list_search_form_skin = 'default';
		load_skin('post_list_search_form', $post_list_search_form_skin);
	}
	
	// 리스트 하단 콜백
	if ( function_exists('after_list') ) {
		after_list();
	}

	// 리스트 스킨
	if ( !$_skinname = $post_cfg['paging_skin'] ) $_skinname = 'default';
	
	
	// 페이지 네이션
	$option = array ( 
					'total_post'=> $total_post,
					'page_no'=>$sy['post']->page_no( $in['page_no'] ),
					'no_of_post'=>$no_of_post,
					'no_of_page'=>10
	);
	
	load_skin('paging', $_skinname, $option);
	
	// 리스트 페이지 네비게이터 하단 콜백
	if ( function_exists('after_paging') ) {
		after_paging();
	}
}
else $sy['js']->alert(lang('List error2'));
?>