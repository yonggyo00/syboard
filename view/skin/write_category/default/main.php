<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<div id='write-category'>
	<?=lang('Write Category sort')?> 
	<select name='category'>
		<option value=''><?=lang('Write Category category')?></option>
		<option value=''></option>
	<?php
	$i=1;
	foreach ( $_category as $key => $value ) {
		if ( $key == $p['category'] ) $selected = 'selected';
		else $selected = null;
		
		echo "<option value='$key' $selected category='category_{$i}'>$key</option>";
		$i++;
	}
	?>
	</select>
	
<?php
	$i=1;
	foreach ( $_category as $key => $value ) {
		if ( $value ) {
			if ( in_array($p['sub_category'], $value) ) {?>
				<script>
					$(document).ready(function(){
						$("select[sub_category='category_<?=$i?>']").show();
					});
				</script>
			
			<?}
			echo "<select class='sub_category' sub_category='category_{$i}'>
					<option value=''>".lang('Write Category sub_category')."</option>
					<option value=''></option>";
			foreach ( $value as $v ) {
				if ( $v == $p['sub_category'] ) $selected = 'selected';
				else $selected = null;
				
				echo "<option $selected value='$v'>$v</option>";
			}
			echo "</select>";
		}
		$i++;
	}
?>
</div>