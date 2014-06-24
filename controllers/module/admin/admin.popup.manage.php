<?php
$pc = $adm->popup_config($in['seq']);
$pcv = $sy['file']->unscalar($pc['value']);

// 각 팝업을 꾸며야 하기 때문에 동적 에디터를 추가한다.
include_once MODULE_PATH . '/post/editor_js.php';
?>
<div id='admin-popup-manage'>
	<div class='admin-sub-title'>팝업 설정 수정</div>
	<div class='admin-row'><span class='sub-title'>번호</span> <?=number_format($pc['seq'])?></div>
	<div class='admin-row'><span class='sub-title'>도메인</span> <?=$pc['domain']?></div>
	
	<form method='post' target='hiframe' autocomplete='off'>
		<input type='hidden' name='module' value='admin' />
		<input type='hidden' name='action' value='admin.popup.manage_submit' />
		<input type='hidden' name='layout' value=1 />
		<input type='hidden' name='seq' value='<?=$pc['seq']?>' />
<?php
	// 최대 가능 팝업은 총 5개로 한다.
	for( $i=1; $i <= 5; $i++ ) {?>
		<div class='admin-row'><span class='sub-title'>팝업<?=$i?></span></div>
		<div>
			<input type='checkbox' name='active_popup[<?=$i?>]' value=1 <?=$pcv['active_popup'][$i]?"checked":""?>/>활성화
		</div>
		
		<fieldset>
			<legend>팝업크기</legend>
			<div>Width <input type='text' name='width[<?=$i?>]' value='<?=$pcv['width'][$i]?>' />px(픽셀)</div>
			<div>Height <input type='text' name='height[<?=$i?>]' value='<?=$pcv['height'][$i]?>' />px(픽셀)</div>
		</fieldset>
		
		<fieldset>
			<legend>팝업위치</legend>
			<div>X좌표 <input type='text' name='xpos[<?=$i?>]' value='<?=$pcv['xpos'][$i]?>' />px(픽셀)</div>
			<div>Y좌표 <input type='text' name='ypos[<?=$i?>]' value='<?=$pcv['ypos'][$i]?>' />px(픽셀)</div>
		</fieldset>
		
		<div class='admin-row'><span class='sub-title'>팝업 내용</span></div>
		<textarea style='height: 300px;' name='content[<?=$i?>]'><?=stripslashes($pcv['content'][$i])?></textarea>
		<input type='submit' value='수정하기' />
		<hr />
<?}?>
	</form>
</div>