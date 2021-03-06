<?=css('css', 'top')?>
<div id='site-top'>
	<div id='site-top-panel'>
		<span id='site-top-left'>
			<a id='site-logo' href='?'>SYBOARD</a>
			<?php
				if ( $sy['mb']->is_login() ) {
					if ( $new = number_format($sy['ms']->no_of_unreaded()) ) {
						$new = "(".$new.")";
					} else $new = null;
				?>
					<a href='?module=member&action=logout' target='hiframe'><?=lang('Login Logout')?></a>
					<a href='?module=member&action=update'><?=lang('Login edit profile')?></a>
					<a href='<?=$sy['ms']->list_url(1)?>'><?=lang('Login Message')?><?=$new?></a>
			<? } else {?>
				<a href='?module=member&action=login_page'><?=lang('Login Login')?></a>
				<a href='<?=$sy['mb']->register_url()?>'><?=lang('Login Register')?></a>
			<?}?>
		</span>
		<span id='site-top-right'>
			<?php
				if ( !$mobile_pc_skin = $site_config['mobile_pc_skin'] ) $mobile_pc_skin = 'default';
				load_skin('mobile_pc', $mobile_pc_skin, array('device'=>$_device));
				
				if ( !$lang_skin = $site_config['lang_skin'] ) $lang_skin = 'default';
				load_skin('lang', $lang_skin, array('lang'=>$_lang));
			?>
		</span>
		<div style='clear:both;'></div>
	</div>
	<div id='site-top-menu-row'>
<?php
		include_once 'menu.php';
?>
	</div>
	<div id='site-top-search-bar'>
<?php
	include_once 'search.php';
?>
	</div>
</div>