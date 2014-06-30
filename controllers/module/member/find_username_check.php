<?php
if ( $sy['mb']->is_login() ) return $sy['js']->location(lang('member find_username_check error1'), "?");

if ( $in['name'] && $in['email'] ) {
	echo "<div id='find-username-check'>";
		if ( $username = $sy['mb']->find_username($in['name'], $in['email']) ) {
			echo "
				<div id='user-info'>
					".lang('member find_username_check your_username1')." <b>".$username."</b>".lang('member find_username_check your_username2')."
					<a href='".$sy['mb']->login_url()."#login_box'>".lang('member find_username_check login')."</a>
				</div>
			";
		}
		else {
			$sy['js']->back(lang('member find_username_check error2'));
		}
	echo "</div>";
}
else $sy['js']->back(lang('member find_username_check error3'));
?>