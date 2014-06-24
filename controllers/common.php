<?php
// 각 경로별 상수를 지정한다.
define('CONTROLLER_PATH', 'controllers');
define('MODULE_PATH', 'controllers/module');
define('CLASS_PATH', 'controllers/class');
define('INDEX_PATH', 'view/index');
define('SKIN_PATH', 'view/skin');
define('MODEL_PATH', 'model');
define('LIB_PATH', 'lib');
define('LIB_JS_PATH', 'lib/js');
define('DOWNLOAD_PATH', 'data/download');
define('LIB_XMLRPC', 'lib/xmlrpc');
define('LANG_PATH', MODEL_PATH.'/lang');

// 파일 디렉토리
define('CACHE_PATH', 'data/cache');
define('USERS_PATH', 'data/users');
define('UPLOAD_PATH', 'data/upload');
define('RESIZED_IMAGE_PATH', 'data/resized_image');
define('FAVICON_PATH', 'data/favicon');

// 데이터베이스 테이블 상수
define('SITE_CONFIG', 'site_config');
define('MEMBER_TABLE', 'member');
define('POST_CONFIG', 'post_config');
define('DATA_TABLE', 'data');
define('POST_DATA_TABLE', 'post_data');
define('COMMENT_DATA_TABLE', 'comment_data');
define('VOTE_TABLE', 'vote');
define('VOTE_COMMENT_TABLE', 'vote_comment');
define('VIEW_COUNT_TABLE', 'view_count');
define('KEYWORD_TABLE', 'keyword');
define('MESSAGE_DATA_TABLE', 'message_data');
define('SCRAP_TABLE', 'scrap');
define('BLOCK_TABLE', 'block');
define('VISITOR_STAT_TABLE', 'visitor_stat');
define('REGISTER_AUTH_TABLE', 'register_auth');
define('POPUP_CONFIG_TABLE', 'popup_config');

// 최대 업로드 가능한 용량 지정 
define('MAX_IMAGE_FILE_SIZE', 5242880); // 이미지는 5메가
define('MAX_VIDEO_FILE_SIZE', 30000000); // 비디오는 30메가
define('MAX_FILE_SIZE', 10000000); // 일반 파일은 10메가

// 공용 함수 인클루드
include_once CONTROLLER_PATH . '/functions.php';

// html parser 인클루드
include_once LIB_PATH . '/htmlparser/simple_html_dom.php';

// 필요한 클라스 인클루드 //
include_once CLASS_PATH . '/mysqli.php';
include_once CLASS_PATH . '/file.php';
include_once CLASS_PATH . '/debug.php';
include_once CLASS_PATH . '/js.php';
include_once CLASS_PATH . '/member.php';
include_once CLASS_PATH . '/post.php';
include_once CLASS_PATH . '/data.php';
include_once CLASS_PATH . '/message.php';
include_once CLASS_PATH . '/imageresizer.php';

// 필요한 라이브러리 인클루드
include_once LIB_XMLRPC.'/lib/xmlrpc.inc'; // 블로그 API용도

// 클라스 객체 생성
$sy['debug'] = new debug();
$sy['file'] = new file();
$sy['js'] = new js();
$sy['post'] = new post();
$sy['data'] = new data();
$sy['ms'] = new message(); 

// 쿠키 도메인 지정
$_domain = domain("http://".$_SERVER['HTTP_HOST']);
$cookie_domain = $_domain[2].$_domain[3];

$cookie_domain = ".".$cookie_domain;

define('COOKIE_DOMAIN', $cookie_domain);


/* 처음 접속할 경우 브라우저아이디를 생성한다. 
*  만약 이미 존재한다면 생성하지 않는다.
*/
set_browser_id();

// 로그인 처리
$_member = array();
$_member =$sy['file']->unscalar($_COOKIE[md5('login_info')]);

// member 객체 생성
$sy['mb'] = new member();

/* 
 * 파이어폭스의 경우 beforeunload가 동작 하지 않아 현재 접속자가 정확하지 않는다. 
 * 파일을 쓴 시간을 확인 해 보고 GUEST로 10분이 지나도록 변화가 없다면 사용자를 삭제한다.
 */
$sy['mb']->current_user_update();
?>