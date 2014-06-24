<?=skin_css($so, __FILE__)?>
<div id='post-list-menu'>
	<? if ( empty($post_cfg['use_login_post']) || ( $sy['mb']->is_login() &&  $post_cfg['use_login_post'])) {?>
		<a href='<?=$sy['post']->write_url($in['post_id'])?>'>글쓰기</a>
	<? }?>
	<a href='<?=$sy['post']->list_url($in['post_id'])?>'>목록</a>
</div>