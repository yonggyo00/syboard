<script>
var select_all = "<?=lang('List bottom select select all')?>";
</script>
<?php
echo module_css(__FILE__);
echo module_javascript(__FILE__);

$post_ids = $sy['post']->post_ids(1);

ob_start();	
echo "
	<select name='move_post_id'>
		<option value=''>".lang('List bottom select forum')."</option>
		<option value=''></option>
";
foreach ( $post_ids as $pid ) {
	echo "<option value='".$pid['post_id']."'>".$pid['subject']."</option>";
}
echo "</select>";
$move_post_id_sel = ob_get_clean();	
?>
<div id='move-post-sel'>
	<span id='move-select-all'><?=lang('List bottom select select all')?></span>
	<?=$move_post_id_sel?>
	<input type='submit' value='<?=lang('List bottom select move')?>' />
</div>