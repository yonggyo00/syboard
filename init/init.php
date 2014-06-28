<?php
session_start();
		
	if (file_exists(dirname(__FILE__) . '/db.php')) {
		include_once 'db.php';
		include_once 'controllers/common.php';
		$sy['db'] = new db ( db_host, db_user, db_password, database );
		
		// 로그인 처리 시 어드민인지 확인 한 후 어드민인 경우 $_member 배열에 is_admin을 추가한다. 이는 쿠키 탈취에 의한 사이트 관리자 페이지 접속을 예방한다.
		if ( $sy['mb']->is_login() ) {
			if ( $sy['mb']->check_admin_in_db() ) {
				$_member['is_admin'] = 'Y';
			}
		}
		
		// IP 보안 처리
		include_once CONTROLLER_PATH .'/ip_sec.php';
		
		// 사이트 설정
		include_once MODEL_PATH . '/site_config.php';
        	   
		// PC, Mobile 버전을 체크
		include_once CONTROLLER_PATH . '/device.php';
		
		// 언어 설정
		include_once CONTROLLER_PATH . '/language.php';
		
		// 새로운 방문자를 방문자 통계에 추가한다.
		insert_visit_stat();
		
		// 방문자 통계 데이터
		include_once MODEL_PATH . '/visitor_stat.php';
		
		// 쿼리 스트링 처리
		include_once CONTROLLER_PATH . '/query_string.php';
	}
	else {
		header('Location: '. $_SERVER['REQUEST_URI'] .'db_config.php');
	}

// title, description, keyword에 들어갈 데이터를 가져온다.
include_once MODEL_PATH . '/meta_data.php';
?>