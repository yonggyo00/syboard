<?php
echo module_css(__FILE__);

$no_of_post = 20;
$total_post = $sy['mb']->total_block_list();

$page_no = $sy['post']->page_no($in['page_no']);

$block_list = $sy['mb']->block_list($page_no, $no_of_post);
?>
<div class='admin-title'>차단 관리</div>
<table id='admin-block' cellpadding=0 cellspacing=0 width='100%'>
	<tr id='tr-header'>
		<td nowrap>번호</td>
		<td nowrap>이름</td>
		<td nowrap>아이디</td>
		<td nowrap>닉네임</td>
		<td nowrap>관리</td>
	</tr>
<?php
foreach ( $block_list as $row ) {
	$info = $sy['mb']->info($row['seq_member']);
	$unblock = "<a class='button' href='?module=admin&action=unblock&seq=".$row['seq']."&layout=1' target='hiframe'>차단해제</a>";
	
	
	$view_posts = "<a class='button' href='?module=admin&action=index&layout=1&option=view_posts&seq_member=".$row['seq_member']."'>글</a>";
	
	$view_comments = "<a class='button' href='?module=admin&action=index&layout=1&option=view_comments&seq_member=".$row['seq_member']."'>댓글</a>";
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