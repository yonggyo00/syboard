<?php
// 로그인 하지 않았다면 guest로 접속한다. 
if ( !$sy['mb']->is_login() ) $sy['mb']->guest();
else {
	$user_data = $sy['file']->read_file(USERS_PATH . "/" . get_browser_id().".user");
	if ( empty($user_data) ) {
		
		$login_info = array(
								'seq'=>$_member['seq'],
								'username'=>$_member['username'],
								'name'=>$_member['name'],
								'nickname'=>$_member['nickname'],
								'block_stamp'=>$_member['block_stamp'],
								'resign_stamp'=>$_member['resign_stamp'],
								'is_admin'=>$_member['is_admin'],
								'ip' => $_SERVER['REMOTE_ADDR'],
								'time' => time()
			);
		$sy['file']->write_file(USERS_PATH . "/" . get_browser_id().".user", $sy['file']->scalar($login_info));
		
	}
}
$current_users =  $sy['mb']->current_user();

$total = intval($current_users['guest']) + intval($current_users['online']);

echo "<div id='no_of_current_user'>".lang('Current user current users').number_format($total)."(".number_format($current_users['online']).")</div>";

echo "<div id='current_users'>";
if ( $current_users['users'] ) {
	foreach ( $current_users['users'] as $cu ) {
		echo "<div>".$cu."</div>";
	}
}
for( $i = 1; $i <= $current_users['guest']; $i++ ) {
	echo "<div>".lang('Current user guest').$i."</div>";
}
echo "</div>";
?>