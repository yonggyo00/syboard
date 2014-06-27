<?php
$info = $sy['post']->post_cfg($in['post_id']);
?>
<div id='sub-admin'>
	<form method='post' autocomplete='off' target='hiframe'>
		<input type="hidden" name="module" value="sub_admin" />
		<input type="hidden" name="action" value="forum_edit_submit" />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='post_id' value='<?=$info['post_id']?>' />
		<input type='hidden' name='seq' value='<?=$info['seq']?>' />
		
		<div class='admin-sub-title'>게시판 수정</div>
		<fieldset>
			<legend>일반 설정</legend>
			<div><span>번호</span><?=number_format($post_cfg['seq'])?></div>
			<div><span>아이디</span><?=$info['post_id']?></div>
			<div><span>제목</span><input type='text' name='subject' value='<?=$info['subject']?>' /></div>
			<div><span>총 글갯수</span><?=$info['no_of_post']?></div>
			<div><span>목록 표시 글 갯수</span><input type='text' name='no_of_post_in_list' value='<?=$info['no_of_post_in_list']?>' /></div>
			<div><input type='checkbox' name='view_with_list' value=1 <?=$info['view_with_list']?'checked':''?> />글보기에 목록 보이기</div>
			<div><input type='checkbox' name='view_with_comment' value=1 <?=$info['view_with_comment']?'checked':''?> />글보기에 코멘트 쓰기 보이기</div>
			<div><input type='checkbox' name='view_with_comment_list' value=1 <?=$info['view_with_comment_list']?'checked':''?> />글보기에 코멘트 목록 보이기</div>
			<div><input type='checkbox' name='use_post_list_search_form' value=1 <?=$info['use_post_list_search_form']?'checked':''?> />목록 하단 검색폼 사용</div>
			
			<div><input type='checkbox' name='use_login_post' value=1 <?=$info['use_login_post']?'checked':''?> />글쓰기 로그인 필수</div>
			<div><input type='checkbox' name='use_secret' value=1 <?=$info['use_secret']?'checked':''?> />비밀글 사용</div>
			<div><input type='checkbox' name='show_ip_view' value=1 <?=$info['show_ip_view']?'checked':''?> />글보기IP보이기</div>
			<div><input type='checkbox' name='show_ip_comment' value=1 <?=$info['show_ip_comment']?'checked':''?> />댓글 IP보이기</div>
			<div><input type='checkbox' name='use_view_vote' value=1 <?=$info['use_view_vote']?'checked':''?> />본문 투표 사용</div>
			<div><input type='checkbox' name='use_comment_vote' value=1 <?=$info['use_comment_vote']?'checked':''?> />댓글 투표 사용</div>
			<div><input type='checkbox' name='blog_api_use' value=1 <?=$post_cfg['blog_api_use']?'checked':''?> />블로그 자동등록 사용</div>
			<div><input type='checkbox' name='map_use' value=1 <?=$post_cfg['map_use']?'checked':''?> />지도 사용</div>
			<div><input type='checkbox' name='use_editor' value=1 <?=$info['use_editor']?'checked':''?> />글쓰기 에디터 사용</div>
			<div><span>게시판 관리자</span> <input type='text' name='admin' value='<?=$info['admin']?>' /></div>
		</fieldset>
		<input type='submit' value='수정하기' />
		
		<fieldset>
			<legend>카테고리 설정</legend>
			<div><span>카테고리</span><input type='text' name='category' value='<?=$info['category']?>' /></div>
			<div><input type='checkbox' name='show_list_category' value=1 <?=$info['show_list_category']?'checked':''?> />리스트 카테고리 사용</div>
			<div><input type='checkbox' name='show_write_category' value=1 <?=$info['show_write_category']?'checked':''?> />글쓰기 카테고리 사용</div>
			
		</fieldset>
		<input type='submit' value='수정하기' />
		
		<fieldset>
			<legend>위젯 설정</legend>
			<div><span>리스트</span> <?=skin_list('post_list', $info['post_list_skin'])?></div>
			<div><span>글쓰기</span> <?=skin_list('write_form', $info['write_form_skin'])?></div>
			<div><span>보기</span> <?=skin_list('view', $info['view_skin'])?></div>
			<div><span>리스트 제목</span> <?=skin_list('list_subject', $info['list_subject_skin'])?></div>
			<div><span>리스트 메뉴</span> <?=skin_list('post_list_menu', $info['post_list_menu_skin'])?></div>
			<div><span>리스트 페이징</span> <?=skin_list('paging', $info['paging_skin'])?></div>
			<div><span>리스트 검색폼</span> <?=skin_list('post_list_search_form', $info['post_list_search_form_skin'])?></div>
			<div><span>글쓰기 게시판 제목</span> <?=skin_list('write_subject', $info['write_subject_skin'])?></div>
			<div><span>보기 메뉴</span> <?=skin_list('view_menu', $info['view_menu_skin'])?></div>
			<div><span>보기 게시판 제목</span> <?=skin_list('view_post_subject', $info['view_post_subject_skin'])?></div>
			<div><span>보기 제목</span> <?=skin_list('view_subject', $info['view_subject_skin'])?></div>
			<div><span>댓글 목록</span> <?=skin_list('comment_list', $info['comment_list_skin'])?></div>
			<div><span>댓글 쓰기</span> <?=skin_list('comment_write_form', $info['comment_write_form_skin'])?></div>
			<div><span>리스트 카테고리</span> <?=skin_list('list_category', $info['list_category_skin'])?></div>
			<div><span>글쓰기 카테고리</span> <?=skin_list('write_category', $info['write_category_skin'])?></div>
			<div><span>공지</span> <?=skin_list('post_list_reminder', $info['post_list_reminder_skin'])?></div>
			<div><span>투표</span> <?=skin_list('vote', $info['vote_skin'])?></div>
			<div><span>댓글 투표</span> <?=skin_list('vote_comment', $info['vote_comment_skin'])?></div>
			<div><span>지도</span> <?=skin_list('map', $info['map_skin'])?></div>
		</fieldset>
		<input type='submit' value='수정하기' />
		
		<fieldset>
			<legend>레벨, 포인트 관리</legend>
			<div><span>글쓰기 레벨</span><input type='text' name='write_level' value='<?=$info['write_level']?>' /></div>
			<div><span>목록 레벨</span><input type='text' name='list_level' value='<?=$info['list_level']?>' /></div>
			<div><span>글 보기 레벨</span><input type='text' name='view_level' value='<?=$info['view_level']?>' /></div>
			<div><span>댓글 쓰기 레벨</span><input type='text' name='comment_write_level' value='<?=$info['comment_write_level']?>' /></div>
			
			<div><span>글쓰기 포인트</span><input type='text' name='point' value='<?=$info['point']?>' /></div>
			<div><span>댓글 포인트</span><input type='text' name='comment_point' value='<?=$info['comment_point']?>' /></div>
		</fieldset>
		
		<fieldset>
			<legend>메타 데이터</legend>
			<div><span>키워드</span><input type='text' name='keywords' value='<?=$info['keywords']?>' /></div>
			<div><span>설명</span><textarea name='description'><?=$info['description']?></textarea></div>
		</fieldset>
		<input type='submit' value='수정하기' />
	</form>
</div>