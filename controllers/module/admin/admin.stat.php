<?php
$site_lists = $adm->site_list('seq,domain, title');
?>
<div id='admin-stat'>
	<div class='admin-title'>방문자 통계</div>
	<table cellpadding=0 cellspacing=0 width='100%'>
		<tr id='tr-header'>
			<td width=70>번호</td>
			<td width=150>도메인</td>
			<td nowrap>제목</td>
			<td width=40></td>
		</tr>
<?php
	foreach ( $site_lists as $sl ) {
		$view_stat = "<a  class='button' href='?module=admin&action=index&option=view_stat&layout=1&domain=".$sl['domain']."'>통계</a>";
		
		echo "
			<tr>
				<td nowrap>$sl[seq]</td>
				<td nowrap>$sl[domain]</td>
				<td nowrap>$sl[title]</td>
				<td nowrap>$view_stat</td>
			</tr>
		";
	}
?>
	</table>
</div>