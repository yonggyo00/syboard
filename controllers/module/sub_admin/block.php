<div id='sub-admin'>
	<div class='title'>차단 관리</div>
<?php
$no_of_post = 20;
$total_post = $sy['mb']->total_block_list();

$page_no = $sy['post']->page_no($in['page_no']);

$block_list = $sy['mb']->block_list($page_no, $no_of_post);
?>
<table cellpadding=0 cellspacing=0 width='100%' border=0>
	<tr id='tr_header'>
		<td>번호</td>
		<td>이름</td>
		<td>아이디</td>
		<td>닉네임</td>
		<td>관리</td>
	</tr>
<?php
foreach ( $block_list as $row ) {
	$info = $sy['mb']->info($row['seq_member']);
	$unblock = "<a href='?module=sub_admin&action=unblock&seq=".$row['seq']."&layout=1' target='hiframe'>차단해제</a>";
	
	
	$view_posts = "<a href='?module=sub_admin&action=view.posts&seq_member=".$row['seq_member']."'>글</a>";
	
	$view_comments = "<a href='?module=sub_admin&action=view.comments&seq_member=".$row['seq_member']."'>댓글</a>";
	echo "
		<tr class='row'>
			<td>".$row['seq']."</td>
			<td>".$info['name']."</td>
			<td>".$info['username']."</td>
			<td>".$info['nickname']."</td>
			<td>{$unblock} {$view_posts} {$view_comments}</td>
		</tr>
	";
}
?>
</table>
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