<?=css('css', 'menu')?>
<ul id='site-top-menu'>
	<li><a menu-id='talk' href='?talk'><?=lang('Post subject talk')?></a></li>
	<li><a menu-id='qna' href='?qna'><?=lang('Post subject qna')?></a></li>
</ul>
<div style='clear:left;'></div>

<style>
#site-top-menu li a[menu-id='<?=$in['post_id']?>'] {
	background-color: #2f4553;
}
</style>