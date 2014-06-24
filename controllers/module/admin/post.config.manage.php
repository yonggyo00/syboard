<?php
echo module_css(__FILE__);
echo module_javascript(__FILE__);

$option = array(
				'post_id'=>$in['post_id'],
				'deleted'=> 'Y'
);

$no_of_post = 20;
$total_post = $sy['post']->total_post($option);

$page_no = $sy['post']->page_no($in['page_no']);

// 삭제된 글 가져오기
$query = "SELECT seq, subject, gid, stamp, nickname, username FROM ".POST_DATA_TABLE." WHERE post_id='".$in['post_id']."' AND deleted='Y'";

$posts = $sy['post']->posts($query, $page_no, $no_of_post);

// 전체 모든 글 개수
$option = array(
				'post_id'=>$in['post_id'],
);

$not_deleted_total_post = $sy['post']->total_post($option);
?>
<div id='post-config-manage'>
	<div class='admin-sub-title'>게시판 글 관리</div>
	<fieldset>
		<legend>전체 글 개수</legend>
		전체글 총 <b><?=number_format($not_deleted_total_post)?></b>개
		<a href='?module=admin&action=post.config.manage_submit&mode=update_total_post&post_id=<?=$in['post_id']?>' target='hiframe'>게시판 설정에 업데이트 하기</a>
	</fieldset>
	<fieldset>
		<legend>삭제표시 글</legend>
		<div>
			<span id='no_of_posts'>삭제표시 글 총 <b><?=number_format($total_post)?></b>개</span>
			
			<div id='delete-all'>
				<form method='post' target='hiframe'>
					<input type='hidden' name='module' value='admin' />
					<input type='hidden' name='action' value='post.config.manage_submit' />
					<input type='hidden' name='layout' value=1 />
					<input type='hidden' name='mode' value='delete_all' />
					<input type='hidden' name='post_id' value='<?=$in['post_id']?>' />
					<input type='submit' value='모든 삭제된글 삭제하기' />
				</form>
			</div>
		</div>
		<form method='post' target='hiframe'>
			<input type='hidden' name='module' value='admin' />
			<input type='hidden' name='action' value='post.config.manage_submit' />
			<input type='hidden' name='layout' value=1 />
<?php
		foreach ( $posts as $post ) {
			$subject = stringcut($post['subject'], 120);
			
			$view_url = $sy['post']->view_url($post['seq']);
			$username = stringcut($post['username'], 9);
			$nickname = stringcut($post['nickname'], 9);
			
			$checkbox = "<input type='checkbox' name='seq[]' value='".$post['seq']."' />";
			
			$recover = "<a style='width: 50px;' href='?module=admin&action=post.config.manage_submit&layout=1&seq=".$post['seq']."&mode=recover' target='hiframe'>[복구]</a>";
			
			echo "
					<div class='row'>
						$recover <a href='$view_url'>$checkbox $subject</a>
						<span class='username'>{$nickname}({$username})</span>
						<div style='clear:right;'></div>
					</div>
			";
		}
?>
			<span id='select-all'>전체선택</span>
			<input type='submit' value='삭제하기' onclick="return confirm('정말로 삭제하시겠습니까?')"/>
		</form>
	</fieldset>
</div>
<?php
// 페이지 네이션
$option = array ( 
				'total_post'=> $total_post,
				'page_no'=>$page_no,
				'no_of_post'=>$no_of_post,
				'no_of_page'=>10
);
	
load_skin('paging', 'default', $option);
?>