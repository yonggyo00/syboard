<?=skin_css($so, __FILE__)?>
<?php
	$info = $sy['mb']->info($_member['seq'], '*');
?>
<div id='resign-skin'>
	<div id='user-info'>
		<div id='title'><?=lang('member resign user_info')?></div>
		<div><span class='sub-title'><?=lang('member resign reg_date')?></span><?=date('Y-m-d', $info['reg_stamp'])?></div>
		<div><span class='sub-title'><?=lang('member resign username')?></span><?=$info['username']?></div>
		<div><span class='sub-title'><?=lang('member resign name')?></span><?=$info['name']?></div>
		<div><span class='sub-title'><?=lang('member resign nickname')?></span><?=$info['nickname']?></div>
		<div><span class='sub-title'><?=lang('member resign point')?></span><?=number_format($info['point'])?></div>
		<div><span class='sub-title'><?=lang('member resign no_of_posts')?></span><?=number_format($sy['post']->no_of_post_by_user($info['seq']))?></div>
		<div><span class='sub-title'><?=lang('member resign no_of_comments')?></span><?=number_format($sy['post']->no_of_comment_by_user($info['seq']))?></div>
		<div id='notice'><?=lang('member resign notice1')?> <a href='?module=post&action=my_posts'/><?=lang('member resign notice2')?></a>, <a href='?module=post&action=my_comments'/><?=lang('member resign notice3')?></a><?=lang('member resign notice4')?></div>
		
		<input type='submit' value='<?=lang('member resign submit')?>' onclick="return confirm('<?=lang('member resign confirm')?>')" />
		
		<div style='clear: right;'></div>
	</div>
</div>