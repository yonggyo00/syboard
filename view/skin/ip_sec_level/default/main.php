<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
	$_levels = $sy['mb']->ip_security_levels();
?>
<div id='ip-sec-level-skin'>
	<div id='title'><?=lang('ip_sec_level title1')?><?=$_levels[$_member['ip_sec_level']]?> <?=lang('ip_sec_level title2')?></div>
	
	<form id='ip-sec-level-form' method='post' target='hiframe'>
		<input type='hidden' name='module' value='member' />
		<input type='hidden' name='action' value='ip_sec_level_submit' />
		<input type='hidden' name='layout' value=1 />
		<div id='sub-title'><?=lang('ip_sec_level sub-title')?></div>
		
		<div id='level-select'>
			<?php
				foreach ( $_levels as $key => $value ) {
					$checked = null;
					if ( $key == $_member['ip_sec_level'] ) $checked = 'checked';
				?>
					<div><input type='radio' name='ip_sec_level' value=<?=$key?> <?=$checked?> /><?=$value?></div>
			<?}?>
		</div>
		<div id='button-group'>
			<input type='submit' value='변경하기' />
			<span id='close'>닫기</span>
		</div>
	<form>
</div>
