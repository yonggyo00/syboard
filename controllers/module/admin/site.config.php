<?php
echo module_javascript(__FILE__);

/* 사이트 레이아웃 셀렉트 박스 */
$sel_site_layout = $adm->sel_site_layout();


/* 사이트 목록 */
ob_start();
?>
<table cellpadding=0 cellspacing=0 width='100%'>
	<tr id='tr-header'>
		<td nowrap>번호</td>
		<td nowrap>도메인</td>
		<td nowrap>제목</td>
		<td nowrap>레이아웃</td>
		<td nowrap align='center'>버전</td>
		<td nowrap colspan=3>관리</td>
	</tr>

<?php
foreach ( $adm->site_list() as $list ) {
	echo "
			<tr nowrap seq=$list[seq]>
				<td nowrap width=70>$list[seq]</td>
				<td nowrap width=150>$list[domain]</td>
				<td nowrap>$list[title]</td>
				<td nowrap>$list[layout]</td>
				<td nowrap align='center'>$list[version]</td>
				<td nowrap id='site_delete'>
					<form method='post'>
						<input type='hidden' name='module' value='$in[module]' />
						<input type='hidden' name='action' value='site_delete' />
						<input type='hidden' name='seq' value='$list[seq]' />
						<input type='submit' value='삭제' />
					</form>
				</td>
				<td nowrap>
					<form method='post'>
						<input type='hidden' name='module' value='$in[module]' />
						<input type='hidden' name='action' value='site_edit' />
						<input type='hidden' name='seq' value='$list[seq]' />
						<input type='submit' value='수정' />
					</form>
				</td>
				<td nowrap>
					<a  class='button' href='?module=admin&action=index&option=member&layout=1&domain=".$list['domain']."'>회원관리</a>
				</td>
			</tr>
	";
}
?>
</table>
<?php
$site_list = ob_get_clean();
?>

<div class='admin-title' id='domain-management'>도메인관리</div>
<div id='admin-domain'>
	<div class='admin-sub-title'>사이트 추가</div>
	<form method='post'>
		<input type='hidden' name='module' value='admin' />
		<input type='hidden' name='action' value='site_config_submit' />
		<div class='admin-row'><span class='sub-title'>도메인</span> <input type='text' name='site_domain' /></div>
		<div class='admin-row'><span class='sub-title'>사이트이름</span> <input type='text' name='site_title' /></div>
		<div class='admin-row'><span class='sub-title'>레이아웃</span> <?=$sel_site_layout?></div>
		<div><input type='submit' value='추가하기' /></div>
	</form>
	<br /><br />
	<div class='admin-sub-title'>사이트 관리</div>
	<?=$site_list?>
	
</div>
