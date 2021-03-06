<?php
echo module_css(__FILE__);

if ( empty($in['seq']) ) return $sy['js']->back(lang('Post_move error4'));

$p = $sy['post']->single_post($in['seq'], "seq, seq_member, subject");
if ( !admin() && !$sy['post']->admin() && !site_admin() ) {
	if ( !$sy['post']->my_post($p['seq_member'] ) ) return $sy['js']->back(lang('Post_move error5'));
}

if ( admin() ) $mode = 1;
else $mode = 0;

$post_ids = $sy['post']->post_ids($mode);

$info = $sy['mb']->info($p['seq_member']);

ob_start();	
echo "
	<select name='move_post_id'>
		<option value=''>".lang('Post_move select_forum')."</option>
		<option value=''></option>
";
foreach ( $post_ids as $pid ) {
	echo "<option value='".$pid['post_id']."'>".$pid['subject']."</option>";
}
echo "</select>";
$move_post_id_sel = ob_get_clean();
?>
<div id='move-single-post'>
	<div id='title'><?=lang('Post_move move_post')?></div>
	<div id='post-info'>
		<div><span class='sub-title'><?=lang('Post_move poster')?></span><?=$info['nickname']."(".$info['username'].")"?></div>
		<div><span class='sub-title'><?=lang('Post_move post_no')?></span><?=number_format($p['seq'])?></div>
		<div><span class='sub-title'><?=lang('Post_move subject')?></span><?=stringcut($p['subject'])?></div>
	</div>
	<form method='post'>
		<input type='hidden' name='module' value='post' />
		<input type='hidden' name='action' value='move_single_post_submit' />
		<input type='hidden' name='seq' value='<?=$in['seq']?>' />
		
		<a id='back-to-post' href='<?=$sy['post']->view_url($in['seq'])?>'><?=lang('Post_move back_to_the_post')?></a>
		
		<div id='submit-button'>
			<?=$move_post_id_sel?>
			<input type='submit' value='<?=lang('Post_move move')?>' onclick="return confirm('<?=lang('Post_move confirm')?>')" />
		</div>
		
		<div style='clear:right;'></div>
	</form>
</div>