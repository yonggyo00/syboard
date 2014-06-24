<?php
	$site_list = $adm->site_list('seq,title,domain,layout');
?>
<div class='admin-title'>도메인별 파비콘 관리</div>
<div class='admin-sub-title'>도메인 선택</div>
<?php
if ( $in['seq'] ) include_once 'favicon.upload.php';
else {
?>

	<table cellpadding=0 cellspacing=0 width='100%'>
		<tr id='tr-header'>
			<td nowrap>번호</td>
			<td nowrap>도메인</td>
			<td nowrap>제목</td>
			<td nowrap>레이아웃</td>
			<td nowrap>관리</td>
		</tr>
	<?php
	foreach ( $site_list as $list ) {
		echo "
			<tr>
				<td width=70>$list[seq]</td>
				<td width=150>$list[domain]</td>
				<td nowrap>$list[title]</td>
				<td nowrap>$list[layout]</td>
				<td nowrap>
					<a class='button' href='?module=admin&action=index&option=favicon&layout=1&seq=$list[seq]&domain=$list[domain]'>관리</a>
				</td>
			</tr>
		";
	}
	?>
	</table>
<?}?>