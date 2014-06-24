<?php
 $popup_configs = $adm->popup_config_list();
?>
<div id='admin-popup'>
	<div class='admin-title'>팝업관리</div>
<?php
	if ( $in['mode'] =='manage' && $in['seq'] ) {
		include_once 'admin.popup.manage.php';
	}
	else if ( $in['mode'] == 'delete' && $in['seq'] ) {
		if ( $adm->delete_popup_config($in['seq']) ) {
			$sy['js']->location("삭제되었습니다.","?module=admin&action=index&option=popup&layout=1");	
		}
	}
	else {
?>
	<div class='admin-sub-title'>팝업설정 추가</div>
	<form class='margin-bottom' method='post' target='hiframe' autocomplete='off'>
		<input type='hidden' name='module' value='admin' />
		<input type='hidden' name='action' value='admin.popup_submit' />
		<input type='hidden' name='layout' value=1 />
		<div class='admin-row'>
			<span class='sub-title'>도메인</span> <input type='text' name='domain' value='<?=$in['domain']?>'/>
		</div>
		<input type='submit' value='추가하기' />
	</form>
	<div class='admin-sub-title'>팝업관리</div>
		<table cellpadding=0 cellspacing=0 width='100%'>
			<tr id='tr-header'>
				<td>번호</td>
				<td>도메인</td>
				<td>관리</td>
			</tr>	
	<?php
		foreach ( $popup_configs as $pc ) {				
?>
			<tr>
				<td><?=$pc['seq']?></td>
				<td><?=$pc['domain']?></td>
				<td><a class='button' href='?module=admin&action=index&option=popup&layout=1&mode=manage&seq=<?=$pc['seq']?>'>관리</a>
				<a class='button' href='?module=admin&action=index&option=popup&layout=1&mode=delete&seq=<?=$pc['seq']?>' onclick="return confirm('정말로 삭제하시겠습니까?')">삭제</a></td>
			</tr>
	<?}?>
		</table>
	<?}?>
</div>