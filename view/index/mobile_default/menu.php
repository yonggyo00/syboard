<?=css('css', 'menu')?>
<?=javascript('js', 'menu')?>
<ul id='site-top-menu'>
	<li class='top-menu'><a href='?'><?=lang('top home')?></a></li>
	<li class='top-menu'><a menu-id='talk' href='?talk'><?=lang('Post subject talk')?></a></li>
	<li class='top-menu'><a menu-id='qna' href='?qna'><?=lang('Post subject qna')?></a></li>
	<li id='mobile-more-button'><img src='<?=INDEX_PATH?>/mobile_default/img/icon-3bar.png' /></li>
</ul>
<div id='mobile-more-button-menu'>
	<div><a href='?'><?=lang('top home')?></a></div>
	<div><a menu-id='talk' href='?talk'><?=lang('Post subject talk')?></a></div>
	<div><a menu-id='qna' href='?qna'><?=lang('Post subject qna')?></a></div>
</div>

<div style='clear:left;'></div>

<style>
#site-top-menu li a[menu-id='<?=$in['post_id']?>'] {
	background-color: #666666;
}
</style>