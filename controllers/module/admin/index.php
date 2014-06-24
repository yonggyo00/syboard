<?php
echo module_css(__FILE__);
include_once 'top.menu.php';
?>
<div id='admin-container'>
<?php
if ( $in['option'] == 'site_config' ) include_once 'site.config.php';
else if ( $in['option'] == 'post_config' ) include_once 'post.config.php';
else if ( $in['option'] == 'admin_block' ) include_once 'admin.block.php';
else if ( $in['option'] == 'view_posts' ) include_once 'view.posts.php';
else if ( $in['option'] == 'view_comments' ) include_once 'view.comments.php';
else if ( $in['option'] == 'cache' ) include_once 'cache.php';
else if ( $in['option'] == 'favicon' ) include_once 'favicon.php';
else if ( $in['option'] == 'member' ) include_once 'member.php';
else if ( $in['option'] == 'file' ) include_once 'admin.file.php';
else if ( $in['option'] == 'stat' ) include_once 'admin.stat.php';
else if ( $in['option'] == 'referral' ) include_once 'admin.referral.php';
else if ( $in['option'] == 'current_user_cache' ) include_once 'admin.current_user_cache.php';
else if ( $in['option'] == 'popup' ) include_once 'admin.popup.php';
else if ( $in['option'] == 'view_stat' ) include_once 'admin.view.stat.php';
else {
	echo "
		<div class='admin-title'>관리자 페이지에 접속하였습니다.</div>
		관리할 메뉴를 선택하세요.
	";
}
?>
</div>
