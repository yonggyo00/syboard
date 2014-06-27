<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
	$_levels = array('매우낮음', '낮음', '중간', '높음');
?>
<div id='ip-sec-level-skin'>
	<div id='title'>회원님의 IP보안 레벨은 <?=$_levels[$_member['ip_sec_level']]?> 입니다.</div>
	
	<form id='ip-sec-level-form' method='post' target='hiframe'>
		<input type='hidden' name='module' value='member' />
		<input type='hidden' name='action' value='ip_sec_level_submit' />
		<input type='hidden' name='layout' value=1 />
		<span id='sub-title'>IP 보안레벨</span>
		<select name='ip_sec_level'>
			<option value=''>IP 보안레벨 선택</option>
			<option value=''></option>
		<?php
			foreach ( $_levels as $index => $value ) {
				$selected = null;
				if ( $index == $_member['ip_sec_level'] ) $selected = 'selected';
				
				echo "<option value={$index} $selected>$value</option>";
		}?>
		</select>
	<form>
	<span id='close'>닫기</span>
</div>
