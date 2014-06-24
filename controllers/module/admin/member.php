<div id='admin-member'>
	<div class='admin-title'>회원관리</div>
<?php
if ( $in['seq'] ) include_once 'admin.member.edit.php';
else {
?>
	<?php
	include_once 'member.search.result.php';
	include_once 'member.search.form.php';

	echo "<div id='no_of_result'>검색된 회원 수 총 <b>".number_format($total_post)."</b>명</div>";
?>
	<table cellpadding=0 cellspacing=0 width='100%'>
		<tr id='tr-header'>
			<td nowrap>번호</td>
			<td nowrap>도메인</td>
			<td nowrap>아이디</td>
			<td nowrap>이름</td>
			<td nowrap>닉네임</td>
			<td nowrap>이메일</td>
			<td nowrap>휴대전화</td>
			<td nowrap>유선전화</td>
			<td nowrap>가입일</td>
			<td nowrap>차단</td>
			<td nowrap>탈퇴</td>
			<td nowrap>관리</td>
		</tr>
<?php
	foreach ( $rows as $row ) {
		$reg_date = date('Ymd', $row['reg_stamp']);
		
		$blocked = null;
		if ( $row['block_stamp'] ) $blocked = date('Ymd', $row['block_stamp']);
		
		$resigned = null;
		if ( $row['resign_stamp'] ) $resigned = date('Ymd', $row['resign_stamp']);
		
		$view_posts = "<a class='button' href='?module=admin&action=index&layout=1&option=view_posts&seq_member=".$row['seq']."'>글</a>";
	
		$view_comments = "<a class='button' href='?module=admin&action=index&layout=1&option=view_comments&seq_member=".$row['seq']."'>댓글</a>";
		
		echo "
			<tr>
				<td>$row[seq]</td>
				<td>$row[domain]</td>
				<td>$row[username]</td>
				<td>$row[name]</td>
				<td>$row[nickname]</td>
				<td>$row[email]</td>
				<td>$row[mobile]</td>
				<td>$row[landline]</td>
				<td>$reg_date</td>
				<td>$blocked</td>
				<td>$resigned</td>
				<td nowrap>
					<a class='button' href='?module=admin&action=index&option=member&layout=1&seq=".$row['seq']."'>관리</a>
					{$view_posts} {$view_comments}
				</td>
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
}
?>
</div>