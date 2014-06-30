<div id='admin-referral'>
	<div class='admin-title'>방문자 유입경로</div>
	
	<?include_once 'admin.referral.search_form.php';?>
	
		<div id='no_of_result'>검색 결과 총 <b><?=number_format($total_posts)?></b>개</div>
		<table cellpadding=0 cellspacing=0 width='100%'>
			<tr id='tr-header'>
				<td nowrap>번호</td>
				<td nowrap>도메인</td>
				<td nowrap>접속일시</td>
				<td nowrap>접속아이피</td>
				<td nowrap>브라우저</td>
				<td nowrap>언어</td>
				<td>접속경로</td>
			</tr>
<?php
	foreach ( $referral as $re ) {
		$ua = user_agent($re['user_agent']);
		$date = date('Y:m:d H:i:s', $re['stamp']);
		$ip = long_2_ip($re['ip']);
		echo "
			<tr>
				<td nowrap>$re[seq]</td>
				<td nowrap>$re[domain]</td>
				<td nowrap>$date</td>
				<td nowrap>$ip</td>
				<td nowrap>$ua</td>
				<td nowrap>$re[language]</td>
				<td width='55%'>$re[referer]</td>
			</tr>	
		";
		
		
	}
?>
	
	</table>
	<?php
	// 페이지 네이션
	$option = array ( 
					'total_post'=> $total_posts,
					'page_no'=>$page_no,
					'no_of_post'=>$no_of_post,
					'no_of_page'=>10
	);
			
	load_skin('paging', 'default', $option);
	?>
</div>