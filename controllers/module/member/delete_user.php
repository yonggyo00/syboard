<?php
if ( $sy['mb']->is_login() ) {
	$sy['file']->write_file(USERS_PATH . "/".get_browser_id().".stamp", time());
}
else {
	@unlink(USERS_PATH . "/" . get_browser_id().".user");
}
?>