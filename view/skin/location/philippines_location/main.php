<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
$provinces = array(
							'Metro Manila',
							'Pampanga',
							'Cebu', 
							'Mindanao'							
);

$region = array();

$region[0] = array (
						'Manila City',
						'Makati City',
						'Pasay City',
						'Muntinlupa City',
						'Mandaluyong City',
						'Pasig City',
						'Quezon City',
						'San Juan City'
);

$region[1] = array (
							'Angeles City',
							'Mabalacat City',
							'San Fernando City'
);

?>
<span id='philippines-location'>
	<select name='province'>
		<option value=''><?=lang('Location select province')?></option>
		<option value=''></option>
	<?php
		foreach ( $provinces as $key=>$value ) {
			$selected = null;
			if ( $so['selected_province'] ) {
				if ( $so['selected_province'] == $value ) {
					$selected = 'selected';?>
						<script>
							$(document).ready(function() {
								$("#philippines-location select[name='province']").change();
							});
						</script>
				<?}
			}
			echo "<option value='$value' cities='$key' $selected>$value</option>";
		}
	?>
	</select>
	<?php
		foreach ( $region as $key => $value ) {?>
			<select class='cities' id='cities_<?=$key?>'>
				<option value=''><?=lang('Location select city')?></option>
				<option value=''></option>
		<?php
				foreach ( $value as $v ) {
					$selected = null;
					if ( $so['selected_city'] ) {
						if ( $so['selected_city'] == $v ) $selected = "selected";
					}
					echo "<option value='$v' $selected>$v</option>";
				}
		?>
			</select>
	<?}?>
</span>