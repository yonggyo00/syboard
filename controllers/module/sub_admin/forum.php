<?php
$forums = explode(",", $site_config['forums']);


$sub_admin_pc = array();
foreach ( $forums as $f ) {
	$sub_admin_pc[] = $sy['post']->post_cfg($f, "seq, post_id, subject, no_of_post");
}
?>
<div id='sub-admin'>
	<div class='title'>게시판 관리</div>
	<table cellpadding=0 cellspacing=0 width='100%'>
		<tr id='tr_header'>
			<td>번호</td>
			<td>아이디</td>
			<td>제목</td>
			<td>글 갯수</td>
			<td>관리</td>
		</tr>
<?php
foreach ( $sub_admin_pc as $spc ) {
	$edit = "<a href='?module=sub_admin&action=forum_edit&post_id=".$spc['post_id']."'>수정</a>";
	
	$post_manage = "<a href='?module=sub_admin&action=forum_post&post_id=".$spc['post_id']."'>글관리</a>";
	
	echo "
		<tr>
			<td>$spc[seq]</td>
			<td>$spc[post_id]</td>
			<td>$spc[subject]</td>
			<td>".number_format($spc['no_of_post'])."</td>
			<td>$edit $post_manage</td>
		</tr>
	";
}
?>
	</table>
</div>