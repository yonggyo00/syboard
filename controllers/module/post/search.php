<?php
if ( $in['key'] || $in['username'] ) {
// 게시판, 댓글 검색 옵션에 따라 테이블 및 필드를 정한다
	if ( empty($in['search_post_comment']) ) $in['search_post_comment'] = 'post';
	
	if ( $in['search_post_comment'] ) {
		if ( $in['search_post_comment'] == 'post' ) {
			$_table_name = POST_DATA_TABLE;
			$_fields = "seq, subject, substr(content_stripped , 1, 200) as content, first_image, nickname, stamp, first_video";
		}
		else {
			$_table_name = COMMENT_DATA_TABLE;
			$_fields = "seq, seq_root, substr(content_stripped , 1, 200) as content, nickname, stamp";
		}
	}
	
	// 상단 검색 폼
	if ( !$search_form_skin = $post_cfg['search_form_skin'] ) $search_form_skin = 'default';
	load_skin('search_form', $search_form_skin);
	
	// 키워드 처리 - 키워드는 공백 또는 콤마(,)로 분리한다.
	$_keywords_tmp = str_replace(".", "", $in['key']);
	$_keywords_tmp = str_replace("!", "", $_keywords_tmp);
	$_keywords_tmp = str_replace("?", "", $_keywords_tmp);
	$_keywords_tmp = str_replace(",", " ", $_keywords_tmp);
	$_keywords = explode(" ", $_keywords_tmp);
	
	if ( $_keywords ) {
		// 키워드 통계를 업데이트 합니다.
		$sy['post']->keywords_update( $_keywords );
	}
	
	include_once 'search.paging.top.php';
	
	include_once MODEL_PATH . '/search_result.php';
	
	// 리스트 스킨
	if ( !$search_list_skin = $post_cfg['search_list_skin'] ) $search_list_skin = 'default';
	load_skin('search_list', $search_list_skin, array('keyword'=>$_keywords, 'total_post'=>$total_post));
	
	
	// 페이징
	if ( !$search_paging_skin = $post_cfg['search_paging_skin'] ) $search_paging_skin = 'default';
	
	$option = array ( 
					'total_post'=> $total_post,
					'page_no'=>$sy['post']->page_no( $in['page_no'] ),
					'no_of_post'=>$no_of_post,
					'no_of_page'=>10
	);
	load_skin('search_paging', $search_paging_skin, $option);
}
else $sy['js']->back("검색어를 입력하세요.");
?>