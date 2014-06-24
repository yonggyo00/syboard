function register_auth_email_sent ( email, is_sent ) {
	var msg;
	if ( is_sent ) {
		msg = success_msg1 + email + success_msg2;
	}
	else msg = fail_msg;
	$("#register-auth #register-auth-message").html(msg);
}