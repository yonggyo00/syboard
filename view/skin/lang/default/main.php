<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
	$lang = array(
					'ko_KR'=>'한국어',
					'en_US'=>'English',			
					'tl_PH'=>'Tagalog'
	);
?>
<span id='lang-default-skin'>
	<form method='get'>
		<select name='lang'>
			<option value=1><?=lang("Lang select")?></option>
			<option value=1></option>
		<?php
			foreach( $lang as $key => $value ) {
				if ( $key == $_lang ) $selected = "selected";
				else $selected = null;
				
				echo "<option value='{$key}' {$selected}>{$value}</option>";
			}
		?>
		</select>
	</form>
</span>
