<?php
echo skin_css($so, __FILE__);
echo skin_javascript($so, __FILE__);
?>
<form id='member-policy-form'>
	<div id='member-policy'>
	<? if ( $site_config['use_terms_conds'] ) {?>
		<div id='first-row'>
			<div class='title'><?=lang('register policy title1')?></div>
			<textarea readonly><?=$site_config['terms_conds']?></textarea>
			<input type='checkbox' name='terms_conds_agree' value=1 /><?=lang('register policy agree')?>
		</div>
	<? }
		else {
			echo "<input style='display: none;' type='checkbox' name='terms_conds_agree' value=1 checked />";
		}
	?>
	
	<? if ( $site_config['use_policy'] ) {?>
		<div>
			<div class='title'><?=lang('register policy title2')?></div>
			<textarea readonly><?=$site_config['policy']?></textarea>
			<input type='checkbox' name='policy_agree' value=1 /><?=lang('register policy agree')?>
		</div>
	<?}
		else { 
			echo "<input style='display: none;' type='checkbox' name='policy_agree' value=1 checked />";
		}
	?>
	
	</div>
	<input type='submit' value='<?=lang('register policy agree')?>' />
	<div style='clear:right;'></div>
</form>