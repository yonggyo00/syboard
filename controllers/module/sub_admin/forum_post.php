<?=module_javascript(__FILE__)?>
<div id='sub-admin'>
<?php
$option = array(
				'post_id'=>$in['post_id'],
				'deleted'=> 'Y'
);

$no_of_post = 20;
$total_post = $sy['post']->total_post($option);

$page_no = $sy['post']->page_no($in['page_no']);

// 삭제된 글 가져오기
$query = "SELECT seq, subject, nickname, username FROM ".POST_DATA_TABLE." WHERE post_id='".$in['post_id']."' AND deleted='Y'";

$posts = $sy['post']->posts($query, $page_no, $no_of_post);
?>
<form method='post' target='hiframe'>
	<input type='hidden' name='module' value='sub_admin' />
	<input type='hidden' name='action' value='forum_delete' />
	<input type='hidden' name='layout' value=1 />
	
	<table cellpadding=0 cellspacing=0 width='100%'>
		<tr id='tr_header'>
			<td width=70></td>
			<td width=70>번호</td>
			<td>제목</td>
			<td>글쓴이</td>
		</tr>

<?php

	foreach ( $posts as $p ) {
		$subject = stringcut($p['subject']);
		$view_url = $sy['post']->view_url($p['seq']);
		$checkbox = "<input type='checkbox' name='seq[]' value='$p[seq]' />";
		$recover = "<a href='?module=sub_admin&action=forum_recover&seq=$p[seq]' target='hiframe'>[복구]</a>";
		echo "
				<tr>
					<td>$checkbox $recover</td>
					<td>$p[seq]</td>
					<td><a href='$view_url'>$subject</a></td>
					<td>$p[nickname]($p[username])</td>
				</tr>
		";
	}
?>
	</table>
	<span id='select-all'>전체선택</span>
	<input type='submit' value='삭제하기' onclick="return confirm('정말로 삭제하시겠습니까?')" />
</form>
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
</div>