<?php
echo module_css(__FILE__);
include_once 'top.menu.php';
?>
<div id='admin-container'>
<?php
if ( $in['done'] ) {
	if ( empty($in['use_css_in_header'])) {
		$data = '<?php $css_header = array();';
		$sy['file']->write_file(css_header_path(), $data);
	}
	
	if ( empty($in['use_js_in_header'])) {
		$data = '<?php $js_header = array();';
		$sy['file']->write_file(js_header_path(), $data);
	}
	// Blog_api 데이터는 scalar 값으로 저장한다.
	$blog_api = array();
	for ( $i=1; $i <=3; $i++ ) {
		$blog_api['blog_api_url'.$i] = $in['blog_api_url'.$i];
		$blog_api['blog_api_account'.$i] = $in['blog_api_account'.$i];
		$blog_api['blog_api_password'.$i] = $in['blog_api_password'.$i];
	}
	
	if ( $in['delete_view_count'] ) {
		// 지정된 기간동안의 뷰카운트를 삭제한다.
		$view_count_stamp = time() - ( 60 * 60 * 24 * $in['view_count_delete'] );
		if ( $sy['db']->query("DELETE FROM " . VIEW_COUNT_TABLE . " WHERE stamp <= $view_count_stamp") ) {
			echo "<div class='admin-title' style='margin-bottom: 10px;' >뷰 카운트 기록이 삭제되었습니다.</div>";
		}
	}
	
	// 업데이트 되는 경우는 캐쉬 파일을 삭제 한다.
	$filename = CACHE_PATH . '/site_config_'.$in['site_domain'].".cache";
	if ( file_exists($filename) ) {
		@unlink($filename);
	}
	
	if ( empty($in['register_point']) ) $in['register_point'] = 0;
	if ( empty($in['use_capcha_in_register']) )  $in['use_capcha_in_register'] = 0;
	if ( empty($in['use_register_auth']) )  $in['use_register_auth'] = 0;
	if ( empty($in['use_facebook']) )  $in['use_facebook'] = 0;
	
	$options = array(
					'domain' => $in['site_domain'],
					'pc_url' => $in['pc_url'],
					'mobile_url'=>$in['mobile_url'],
					'title' => $in['site_title'],
					'sub_title' => $in['site_sub_title'],
					'description' => $in['site_description'],
					'keyword' => $in['site_keyword'],
					'layout' => $in['site_layout'],
					'version' => $in['version'],
					'blog_api' => $sy['file']->scalar($blog_api),
					'use_cache' => $in['use_cache'],
					'use_debuging_log' => $in['use_debuging_log'],
					'permit_nickname_change' => $in['permit_nickname_change'],
					'use_captcha' => $in['use_captcha'],
					'visitor_stat_minutes' => intval($in['visitor_stat_minutes']),
					'search_stat_minutes' => intval($in['search_stat_minutes']),
					'view_count_delete' => intval($in['view_count_delete']),
					'use_css_in_header' => $in['use_css_in_header'],
					'use_js_in_header' => $in['use_js_in_header'],
					'login_skin' => $in['login_skin'],
					'login_page_skin'=>$in['login_page_skin'],
					'register_skin' => $in['register_skin'],
					'resign_skin' => $in['resign_skin'],
					'mobile_pc_skin' => $in['mobile_pc_skin'],
					'lang_skin' => $in['lang_skin'],
					'search_form_skin' => $in['search_form_skin'],
					'search_list_skin' => $in['search_list_skin'],
					'search_paging_skin' => $in['search_paging_skin'],
					'my_scrap_list_skin' => $in['my_scrap_list_skin'],
					'keyword_stat_skin' => $in['keyword_stat_skin'],
					'current_user_skin' => $in['current_user_skin'],
					'visitor_stat_skin' => $in['visitor_stat_skin'],
					'message_write_form_skin' => $in['message_write_form_skin'],
					'message_list_skin' => $in['message_list_skin'],
					'message_view_skin' => $in['message_view_skin'],
					'captcha_skin' => $in['captcha_skin'],
					'secret_check_skin' => $in['secret_check_skin'],
					'guest_secret_check_skin'=>$in['guest_secret_check_skin'],
					'accounts_cannot_be_used' => $in['accounts_cannot_be_used'],
					'names_cannot_be_used' => $in['names_cannot_be_used'],
					'words_cannot_be_used' => $in['words_cannot_be_used'],
					'terms_conds' => $in['terms_conds'],
					'policy' => $in['policy'],
					'use_terms_conds' => $in['use_terms_conds'],
					'use_policy' => $in['use_policy'],
					'register_point' => $in['register_point'],
					'use_capcha_in_register'=>$in['use_capcha_in_register'],
					'my_posts_skin' => $in['my_posts_skin'],
					'my_comments_skin' => $in['my_comments_skin'],
					'use_register_auth'=>$in['use_register_auth'],
					'use_facebook'=>$in['use_facebook'],
					'use_twitter' => $in['use_twitter'],
					'admin'=>$in['admin'],
					'not_searching_forum'=>$in['not_searching_forum'],
					'forums'=>$in['forums'],
					'level' => $sy['file']->scalar($in['level']) // 레벨별 포인트는 스칼라 값으로 변환 한 후 데이터 테이블에 업데이트 한다.
	);
	
	if ( $sy['db']->update( SITE_CONFIG, $options, array('seq' => $in['seq'])) ) {
		$msg = "수정되었습니다.";
	}
	else {
		$msg = "수정에 실패하였습니다.";
	}
	
	echo "<div class='admin-title' style='margin-bottom: 10px;' >$msg</div>";
}
$info = $sy['db']->row("SELECT * FROM ". SITE_CONFIG . " WHERE seq='".$in['seq']."'");

/* 사이트 레이아웃 셀렉트 박스 */
$sel_site_layout = $adm->sel_site_layout( $info['layout'] );
?>
	<div class='admin-title'>
		사이트 정보 수정
	</div>
	<form method='post' autocomplete='off'>
		<input type='hidden' name='module' value='<?=$in['module']?>' />
		<input type='hidden' name='action' value='site_edit' />
		<input type='hidden' name='seq' value='<?=$in['seq']?>' />
		<input type='hidden' name='done' value=1 />
		
		<div class='admin-sub-title'>도메인 관리</div>
		<div class='admin-row'><span class='sub-title'>도메인</span> <input type='text' name='site_domain' value='<?=$info['domain']?>' /></div>
		<div class='admin-row'><span class='sub-title'>PC버전 주소</span> <input type='text' name='pc_url' value='<?=$info['pc_url']?>' /></div>
		<div class='admin-row'><span class='sub-title'>모바일버전 주소</span> <input type='text' name='mobile_url' value='<?=$info['mobile_url']?>' /></div>
		<div class='admin-row'><span class='sub-title'>사이트 제목</span> <input type='text' name='site_title' value='<?=$info['title']?>' /></div>
		<div class='admin-row'><span class='sub-title'>사이트 부제목</span> <input type='text' name='site_sub_title' value='<?=$info['sub_title']?>' /></div>
		<div class='admin-row'><span class='sub-title'>사이트 설명</span></div>
		<div class='admin-row'><textarea name='site_description'><?=$info['description']?></textarea></div>
		<div class='admin-row'><span class='sub-title'>사이트 키워드</span></div>
		<div class='admin-row'><textarea name='site_keyword'><?=$info['keyword']?></textarea></div>
		<div class='admin-row'><span class='sub-title'>레이아웃</span> <?=$sel_site_layout?></div>
		<div class='admin-row'><span class='sub-title'>어드민</span> <input type='text' name='admin' value='<?=$info['admin']?>' /></div>
		<input type='submit' value='수정하기' />
		<div class='admin-sub-title'>CSS & JAVASCRIPT</div>
		<div class='admin-row'><span class='sub-title'>버전</span> <input type='text' name='version' value='<?=$info['version']?>' /></div>
		<input type='submit' value='수정하기' />
		
		<div class='admin-sub-title'>일반 설정</div>
		<div class='admin-row'><input type='checkbox' name='use_cache'  value=1 <?=$info['use_cache']?'checked':''?>/> 캐쉬 사용</div>
		<div class='admin-row'><input type='checkbox' name='use_captcha'  value=1 <?=$info['use_captcha']?'checked':''?>/> 보안문자 사용</div>
		<div class='admin-row'><input type='checkbox' name='use_debuging_log' value=1 <?=$info['use_debuging_log']?'checked':''?>/> 디버깅 로그 사용</div>
		<div class='admin-row'><input type='checkbox' name='permit_nickname_change' value=1 <?=$info['permit_nickname_change']?'checked':''?>/> 닉네임 변경 허용</div>
		<div class='admin-row'><input type='checkbox' name='use_capcha_in_register' value=1 <?=$info['use_capcha_in_register']?'checked':''?> /> 회원가입 보안문자</div>
		<div class='admin-row'><input type='checkbox' name='use_register_auth' value=1 <?=$info['use_register_auth']?'checked':''?> /> 회원가입 이메일 인증 사용</div>
		
		<div class='admin-row'><input type='checkbox' name='use_css_in_header' value=1 <?=$info['use_css_in_header']?'checked':''?> /> 헤더로 CSS 모으기</div>
		
		<div class='admin-row'><input type='checkbox' name='use_js_in_header' value=1 <?=$info['use_js_in_header']?'checked':''?> /> 헤더로 JAVASCRIPT 모으기</div>
		
		<div class='admin-row'><input type='checkbox' name='use_facebook' value=1 <?=$info['use_facebook']?'checked':''?> /> 페이스북 LIKE, SHARE 사용</div>
		<div class='admin-row'><input type='checkbox' name='use_twitter' value=1 <?=$info['use_twitter']?'checked':''?> /> 트위터 Tweet, Follow사용</div>
		
		<div class='admin-row'><span class='sub-title'>접속자 통계 업데이트 시간(분)</span> <input type='text' name='visitor_stat_minutes' value='<?=$info['visitor_stat_minutes']?>' /></div>
		
		<div class='admin-row'><span class='sub-title'>검색어 통계 업데이트 시간(분)</span> <input type='text' name='search_stat_minutes' value='<?=$info['search_stat_minutes']?>' /></div>
		
		<div class='admin-row'><span class='sub-title'>뷰 카운트 삭제 간격(일)</span> <input type='text' name='view_count_delete' value='<?=$info['view_count_delete']?>' />
			<input type='checkbox' name='delete_view_count' value=1 /> 뷰카운트 삭제
		</div>
	
		<input type='submit' value='수정하기' />
		
		<div class='admin-sub-title'>스킨 관리</div>
		
		<div class='admin-row'><span class='sub-title'>로그인</span> <?=$adm->skin_list('login', $info['login_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>로그인 페이지</span><?=$adm->skin_list('login_page', $info['login_page_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>회원가입</span> <?=$adm->skin_list('register', $info['register_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>회원탈퇴</span> <?=$adm->skin_list('resign', $info['resign_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>나의 글</span> <?=$adm->skin_list('my_posts', $info['my_posts_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>나의 댓글</span> <?=$adm->skin_list('my_comments', $info['my_comments_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>모바일, PC변환</span> <?=$adm->skin_list('mobile_pc', $info['mobile_pc_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>언어</span> <?=$adm->skin_list('lang', $info['lang_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>검색폼</span> <?=$adm->skin_list('search_form', $info['search_form_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>검색리스트</span> <?=$adm->skin_list('search_list', $info['search_list_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>검색페이징</span> <?=$adm->skin_list('search_paging', $info['search_paging_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>내스크랩 리스트</span> <?=$adm->skin_list('my_scrap_list', $info['my_scrap_list_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>검색통계</span> <?=$adm->skin_list('keyword_stat', $info['keyword_stat_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>쪽지 쓰기</span><?=$adm->skin_list('message_write_form', $info['message_write_form_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>쪽지 리스트</span><?=$adm->skin_list('message_list', $info['message_list_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>쪽지 보기</span><?=$adm->skin_list('message_view', $info['message_view_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>현재접속자</span> <?=$adm->skin_list('current_user', $info['current_user_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>방문자통계</span> <?=$adm->skin_list('visitor_stat', $info['visitor_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>보안문자</span> <?=$adm->skin_list('captcha', $info['captcha_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>비밀글확인</span> <?=$adm->skin_list('secret_check', $info['secret_check_skin'])?></div>
		<div class='admin-row'><span class='sub-title'>게스트글비밀번호확인</span> <?=$adm->skin_list('guest_secret_check', $info['guest_secret_check_skin'])?></div>
		
		
		<input type='submit' value='수정하기' />
		
		
		<div class='admin-sub-title'>회원가입관리</div>
		
		<div class='admin-row'><span class='sub-title'>사용금지 아이디,닉네임 등록</span></div>
		<div class='admin-row'><textarea name='accounts_cannot_be_used'><?=$info['accounts_cannot_be_used']?></textarea></div>
		<div class='admin-row'><span class='sub-title'>사용금지 이름 등록</span></div> 
		<div class='admin-row'><textarea name='names_cannot_be_used'><?=$info['names_cannot_be_used']?></textarea></div>
		
		<div class='admin-row'><input type='checkbox' name='use_terms_conds' value=1 <?=$info['use_terms_conds']?'checked':''?> />회원가입약관사용</div>
		<div class='admin-row'><span class='sub-title'>회원가입약관</span></div>
		<div class='admin-row'><textarea name='terms_conds'><?=$info['terms_conds']?></textarea></div>
		
		<div class='admin-row'><input type='checkbox' name='use_policy' value=1 <?=$info['use_policy']?'checked':''?> />개인보호정책사용</div>
		<div class='admin-row'><span class='sub-title'>개인보호정책</span></div>
		<div class='admin-row'><textarea name='policy'><?=$info['policy']?></textarea></div>
		
		<div class='admin-row'><span class='sub-title'>회원 가입 포인트</span> <input type='text' name='register_point' value='<?=$info['register_point']?>' /></div>
		
		<input type='submit' value='수정하기' />
		
		<div class='admin-sub-title'>블로그 API</div>
<?php
	$blog_api_info = array();
	if ( $info['blog_api'] ) $blog_api_info = $sy['file']->unscalar($info['blog_api']);
	for( $i = 1; $i <= 3; $i++ ) {?>
		<div class='admin-row'><span class='sub-title'>API 연결 URL<?=$i?></span> <input type='text' name='blog_api_url<?=$i?>' value='<?=$blog_api_info['blog_api_url'.$i]?>' /></div>
		<div class='admin-row'><span class='sub-title'>계정<?=$i?></span> <input type='text' name='blog_api_account<?=$i?>' value='<?=$blog_api_info['blog_api_account'.$i]?>' /></div>
		<div class='admin-row'><span class='sub-title'>비밀번호<?=$i?></span> <input type='text' name='blog_api_password<?=$i?>' value='<?=$blog_api_info['blog_api_password'.$i]?>' /></div>
		<hr />
	<? }?>	
		<input type='submit' value='수정하기' />
		
		<div class='admin-sub-title'>글쓰기 관리</div>
		<div class='admin-row'><span class='sub-title'>게시판</span> <input type='text' name='forums' value='<?=$info['forums']?>' /></div>
		<div class='admin-row'><span class='sub-title'>사용금지 단어 등록</span><div>
		<div class='admin-row'><textarea name='words_cannot_be used'><?=$info['words_cannot_be_used']?></textarea></div>
		<div class='admin-row'><span class='sub-title'>검색 비허용 게시판</span> <input type='text' name='not_searching_forum' value='<?=$info['not_searching_forum']?>' /></div>
		<input type='submit' value='수정하기' />
		
		<div class='admin-sub-title'>포인트/레벨관리</div>
<?php
	$level = array();
	if ( $info['level'] ) $level = $sy['file']->unscalar($info['level']);
	
	for ( $i=1; $i <= 20; $i++ ) {
		if ( empty($level[$i]) ) $default_value = 1000 * $i;
		else $default_value = $level[$i];
	?>
		<div class='admin-row'><span class='sub-title'>레벨<?=$i?></span> <input type='text' name='level[<?=$i?>]' value='<?=$default_value?>' /></div>
	<?}?>
	<input type='submit' value='수정하기' />
	</form>
</div>