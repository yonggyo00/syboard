<div id='post-config-edit'>
	<form method='post' autocomplete='off'>
		<input type="hidden" name="module" value="admin" />
		<input type="hidden" name="action" value="index" />
		<input type="hidden" name="option" value="post_config" />
		<input type="hidden" name="layout" value=1 />
		<input type='hidden' name='mode' value='edit' />
		<input type='hidden' name='edit_done' value=1 />
		<input type='hidden' name='post_id' value='<?=$post_cfg['post_id']?>' />
		<input type='hidden' name='seq' value='<?=$post_cfg['seq']?>' />
		
		<div class='admin-sub-title'>게시판 수정</div>
		<fieldset>
			<legend>일반 설정</legend>
			<div class='admin-row'><span class='sub-title'>번호</span><?=number_format($post_cfg['seq'])?></div>
			<div class='admin-row'><span class='sub-title'>아이디</span><?=$post_cfg['post_id']?></div>
			<div class='admin-row'><span class='sub-title'>제목</span><input type='text' name='subject' value='<?=$post_cfg['subject']?>' /></div>
			<div class='admin-row'><span class='sub-title'>총 글갯수</span><?=$post_cfg['no_of_post']?></div>
			<div class='admin-row'><span class='sub-title'>목록 표시 글 갯수</span><input type='text' name='no_of_post_in_list' value='<?=$post_cfg['no_of_post_in_list']?>' /></div>
			<div class='admin-row'><input type='checkbox' name='view_with_list' value=1 <?=$post_cfg['view_with_list']?'checked':''?> />글보기에 목록 보이기</div>
			<div class='admin-row'><input type='checkbox' name='view_with_comment' value=1 <?=$post_cfg['view_with_comment']?'checked':''?> />글보기에 코멘트 쓰기 보이기</div>
			<div class='admin-row'><input type='checkbox' name='view_with_comment_list' value=1 <?=$post_cfg['view_with_comment_list']?'checked':''?> />글보기에 코멘트 목록 보이기</div>
			<div class='admin-row'><input type='checkbox' name='use_post_list_search_form' value=1 <?=$post_cfg['use_post_list_search_form']?'checked':''?> />목록 하단 검색폼 사용</div>
			<div class='admin-row'><input type='checkbox' name='use_login_post' value=1 <?=$post_cfg['use_login_post']?'checked':''?> />글쓰기 로그인 필수</div>
			<div class='admin-row'><input type='checkbox' name='use_secret' value=1 <?=$post_cfg['use_secret']?'checked':''?> />비밀글 사용</div>
			<div class='admin-row'><input type='checkbox' name='show_ip_view' value=1 <?=$post_cfg['show_ip_view']?'checked':''?> />글보기IP보이기</div>
			<div class='admin-row'><input type='checkbox' name='show_ip_comment' value=1 <?=$post_cfg['show_ip_comment']?'checked':''?> />댓글 IP보이기</div>
			<div class='admin-row'><input type='checkbox' name='use_view_vote' value=1 <?=$post_cfg['use_view_vote']?'checked':''?> />본문 투표 사용</div>
			<div class='admin-row'><input type='checkbox' name='use_comment_vote' value=1 <?=$post_cfg['use_comment_vote']?'checked':''?> />댓글 투표 사용</div>
			<div class='admin-row'><input type='checkbox' name='blog_api_use' value=1 <?=$post_cfg['blog_api_use']?'checked':''?> />블로그 자동등록 사용</div>
			<div class='admin-row'><input type='checkbox' name='map_use' value=1 <?=$post_cfg['map_use']?'checked':''?> />지도 사용</div>
			<div class='admin-row'><input type='checkbox' name='use_editor' value=1 <?=$post_cfg['use_editor']?'checked':''?> />글쓰기 에디터 사용</div>
			<div class='admin-row'><span class='sub-title'>게시판 관리자</span> <input type='text' name='admin' value='<?=$post_cfg['admin']?>' /></div>
		</fieldset>
		<input type='submit' value='수정하기' />
		
		<fieldset>
			<legend>카테고리 설정</legend>
			<div class='admin-row'><span class='sub-title'>카테고리</span><input type='text' name='category' value='<?=$post_cfg['category']?>' /></div>
			<div class='admin-row'><input type='checkbox' name='show_list_category' value=1 <?=$post_cfg['show_list_category']?'checked':''?> />리스트 카테고리 사용</div>
			<div class='admin-row'><input type='checkbox' name='show_write_category' value=1 <?=$post_cfg['show_write_category']?'checked':''?> />글쓰기 카테고리 사용</div>
			
		</fieldset>
		<input type='submit' value='수정하기' />
		
		<fieldset>
			<legend>위젯 설정</legend>
			<div class='admin-row'><span class='sub-title'>리스트</span> <?=$adm->skin_list('post_list', $post_cfg['post_list_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>글쓰기</span> <?=$adm->skin_list('write_form', $post_cfg['write_form_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>보기</span> <?=$adm->skin_list('view', $post_cfg['view_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>리스트 제목</span> <?=$adm->skin_list('list_subject', $post_cfg['list_subject_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>리스트 메뉴</span> <?=$adm->skin_list('post_list_menu', $post_cfg['post_list_menu_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>리스트 페이징</span> <?=$adm->skin_list('paging', $post_cfg['paging_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>리스트 검색폼</span> <?=$adm->skin_list('post_list_search_form', $post_cfg['post_list_search_form_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>글쓰기 게시판 제목</span> <?=$adm->skin_list('write_subject', $post_cfg['write_subject_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>보기 메뉴</span> <?=$adm->skin_list('view_menu', $post_cfg['view_menu_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>보기 게시판 제목</span> <?=$adm->skin_list('view_post_subject', $post_cfg['view_post_subject_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>보기 제목</span> <?=$adm->skin_list('view_subject', $post_cfg['view_subject_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>댓글 목록</span> <?=$adm->skin_list('comment_list', $post_cfg['comment_list_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>댓글 쓰기</span> <?=$adm->skin_list('comment_write_form', $post_cfg['comment_write_form_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>리스트 카테고리</span> <?=$adm->skin_list('list_category', $post_cfg['list_category_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>글쓰기 카테고리</span> <?=$adm->skin_list('write_category', $post_cfg['write_category_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>공지</span> <?=$adm->skin_list('post_list_reminder', $post_cfg['post_list_reminder_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>투표</span> <?=$adm->skin_list('vote', $post_cfg['vote_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>댓글 투표</span> <?=$adm->skin_list('vote_comment', $post_cfg['vote_comment_skin'])?></div>
			<div class='admin-row'><span class='sub-title'>지도</span> <?=$adm->skin_list('map', $post_cfg['map_skin'])?></div>
		</fieldset>
		<input type='submit' value='수정하기' />
		
		<fieldset>
			<legend>레벨, 포인트 관리</legend>
			<div class='admin-row'><span class='sub-title'>글쓰기 레벨</span><input type='text' name='write_level' value='<?=$post_cfg['write_level']?>' /></div>
			<div class='admin-row'><span class='sub-title'>목록 레벨</span><input type='text' name='list_level' value='<?=$post_cfg['list_level']?>' /></div>
			<div class='admin-row'><span class='sub-title'>글 보기 레벨</span><input type='text' name='view_level' value='<?=$post_cfg['view_level']?>' /></div>
			<div class='admin-row'><span class='sub-title'>댓글 쓰기 레벨</span><input type='text' name='comment_write_level' value='<?=$post_cfg['comment_write_level']?>' /></div>
			
			<div class='admin-row'><span class='sub-title'>글쓰기 포인트</span><input type='text' name='point' value='<?=$post_cfg['point']?>' /></div>
			<div class='admin-row'><span class='sub-title'>댓글 포인트</span><input type='text' name='comment_point' value='<?=$post_cfg['comment_point']?>' /></div>
		</fieldset>
		
		<fieldset>
			<legend>메타 데이터</legend>
			<div class='admin-row'><span class='sub-title'>키워드</span><input type='text' name='keywords' value='<?=$post_cfg['keywords']?>' /></div>
			<div class='admin-row'><span class='sub-title'>설명</span></div>
			<div class='admin-row'><textarea name='description'><?=$post_cfg['description']?></textarea></div>
		</fieldset>
		<input type='submit' value='수정하기' />
	</form>
</div>