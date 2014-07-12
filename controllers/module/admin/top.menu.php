<?php
echo module_css(__FILE__);
echo module_javascript(__FILE__);
?>
<ul id='admin-top-menu'>
	<li class='mainmenu'>
		<a href='?module=admin&action=index&option=site_config&layout=1'>사이트설정</a>
	</li>
	<li class='mainmenu'>
		<a href='?module=admin&action=index&option=popup&layout=1'>팝업관리</a>
	</li>
	<li class='mainmenu' menu_no=2>
		<a href='?module=admin&action=index&option=member&layout=1'>회원관리</a>
		<ul class='submenu' submenu_no=2>
			<li><a href='?module=admin&action=index&option=member&layout=1'>회원관리</a></li>
			<li><a href='?module=admin&action=index&option=current_user_cache&layout=1'>접속자캐시관리</a></li>
		</ul>
	</li>
	<li class='mainmenu'>
		<a href='?module=admin&action=index&option=post_config&layout=1'>게시판</a>
	</li>
	<li class='mainmenu'>
		<a href='?module=admin&action=index&option=admin_block&layout=1'>차단 관리</a>
	</li>
	<li class='mainmenu'>
		<a href='?module=admin&action=index&option=cache&layout=1'>캐시관리</a>
	</li>
	<li class='mainmenu'>
		<a href='?module=admin&action=index&option=file&layout=1'>파일관리</a>
	</li>
	<li class='mainmenu'>
		<a href='?module=admin&action=index&option=favicon&layout=1'>파비콘</a>
	</li>
	<li class='mainmenu' menu_no=3>
		<a href='?module=admin&action=index&option=stat&layout=1'>통계</a>
		<ul class='submenu' submenu_no=3>
			<li><a href='?module=admin&action=index&option=stat&layout=1'>방문자통계</a></li>
			<li><a href='?module=admin&action=index&option=referral&layout=1'>유입경로</a></li>
		</ul>
	</li>
	<li class='mainmenu-below-980'>
		<img id='top-more-button' src='<?=MODULE_PATH?>/admin/img/icon-3bar.png' />
	</li>
	<li class='mainmenu'>
		<a href='?module=admin&action=index&option=calendar&layout=1'>스케줄관리</a>
	</li>
</ul>
<div style='clear:left;'></div>
<?php
include_once 'top.more.button.php';
?>