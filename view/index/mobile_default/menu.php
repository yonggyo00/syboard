<?=css('css', 'menu')?>
<?=javascript('js', 'menu')?>
<ul id='site-top-menu'>
	<li class='top-menu'><a href='?'><?=lang('top home')?></a></li>
	<li class='top-menu'><a menu-id='talk' href='?talk'><?=lang('Post subject talk')?></a></li>
	<li class='top-menu'><a menu-id='qna' href='?qna'><?=lang('Post subject qna')?></a></li>
	
<?php
	if ( admin() ) {?>
		<li class='top-menu'><a href='?module=admin&action=index&layout=1' target='_blank'><?=lang("Login Site Panel")?></a></li>
	<?}?>
			
<?php
	if ( site_admin() ) {?>
		<li class='top-menu'><a id='site-admin' href='?module=sub_admin&action=index'><?=lang('Login Site Panel')?></a></li>
	<?}?>
	
	<li id='mobile-more-button'><img src='<?=INDEX_PATH?>/mobile_default/img/icon-3bar.png' /></li>
</ul>
<div style='clear:left;'></div>

<div id='mobile-more-button-menu'>
	<div><a href='?'><?=lang('top home')?></a></div>
	<div><a menu-id='talk' href='?talk'><?=lang('Post subject talk')?></a></div>
	<div><a menu-id='qna' href='?qna'><?=lang('Post subject qna')?></a></div>
<?php
	if ( admin() ) {?>
		<div><a href='?module=admin&action=index&layout=1' target='_blank'><?=lang("Login Site Panel")?></a></div>
	<?}?>
			
<?php
	if ( site_admin() ) {?>
		<div><a id='site-admin' href='?module=sub_admin&action=index'><?=lang('Login Site Panel')?></a></div>
	<?}?>
</div>

<?php 
if ( $in['post_id'] ) {?> 
	<style>
	#site-top-menu li a[menu-id='<?=$in['post_id']?>'] {
		background-color: #666666;
	}
	</style>
<? }?>