<?php
// 게시판 존재 여부 확인
if ( $in['post_id'] ) {
	if ( !$sy['post']->post_id_exist($in['post_id']) ) return $sy['js']->back("게시판이 존재하지 않습니다.");
}

// 콜백 스크립트 인클루드
include_once site_path() . '/callback.php';

// 게시판 환경 설정 정보 가져오기
include_once MODEL_PATH . '/post_cfg.php';
?>