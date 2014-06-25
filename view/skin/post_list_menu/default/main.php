<?=skin_css($so, __FILE__)?>
<div id='post-list-menu'>
	<? if ( empty($post_cfg['use_login_post']) || ( $sy['mb']->is_login() &&  $post_cfg['use_login_post'])) {?>
		<a href='<?=$sy['post']->write_url($in['post_id'])?>'><?=lang('Post_list_menu write')?></a>
	<? }?>
	<a href='<?=$sy['post']->list_url($in['post_id'])?>'><?=lang('Post_list_menu list')?></a>
</div>