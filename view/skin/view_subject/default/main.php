<?php
echo skin_css( $so, __FILE__ );
echo skin_javascript( $so, __FILE__ );

if ( $post_cfg['show_ip_view'] ) {
	$view_ip_tmp = explode(".", long_2_ip($p['ip']));
	$view_ip_tmp[2] = '***';
	$view_ip = "&nbsp;&nbsp;&nbsp;<span id='view-ip'><b>IP</b> " . implode(".", $view_ip_tmp). "</span>";
}
// 프로필 이미지
if ( $image_url = $sy['mb']->profile_photo($p['seq_member'], 45, 45) ) {
	$profile_photo = "<div id='profile-photo'><img src='".$image_url."' /></div>";
}
else $profile_photo = "<div id='profile-photo'><img src='".$so['path']."/img/profile.png' /></div>";

$user_info = $sy['mb']->info($p['seq_member'], "signature");
$signature = stringcut($user_info['signature'], 90);

if ( empty($p['guest_secret'] ) ) {
	if ( $sy['mb']->is_login() ) $view_send_message = "view-send-message";
	else $view_send_message = 'view-send-message-without-login';
	
	$view_user_popup = "
						<div id='view-user-popup'>
							<div><span id='$view_send_message' popup_url='".$sy['ms']->sendto($p['username'])."'>".lang('View subject send message')."</span></div>
							<div><a href='".$sy['post']->search_user_post_url($p['username'])."'>".lang('View subject view posts')."</a></div>
						</div>
	";
}else $view_user_popup = null;
?>
<div id='view-user-info'>
	<?=$profile_photo?>
	<div id='right'>
		<div id='user-info'>
			<span id='user-info-left'>
				<span id='view-username'>
					<b><?=lang('View subject post by')?></b> <?=$p['nickname']?>(<?=$p['username']?>)
				</span>
				<?=$view_user_popup?>
				<?=$view_ip?>
			</span>
			<span id='user-info-right'>
				<span id='no_of_view'>
					<b><?=lang('View subject views')?></b> <?=number_format($p['no_of_view'])?>
				</span>
				<span id='view-date'>
					<b><?=lang('View subject date')?></b> <?=date("Y-m-d H:i", $p['stamp'])?>
				</span>
			</span>
		</div>
		<div id='signature'><?=$signature?></div>
	</div>
	<div style='clear:left;'></div>
</div>
<?php
// 글 제목 상단 콜백
if ( function_exists('before_view_subject') ) {
		before_view_subject();
}
?>
<div id="view-subject">
	<?=stripslashes($p['subject'])?>
</div>