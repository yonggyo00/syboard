<?php
if ( $in['seq'] ) {
	if ( $in['post_secret'] ) {
		if ( strlen($in['post_secret']) == 6 ) {
			$_SESSION['post_no_'.$in['seq']."_secret"] = md5($in['post_secret']);
			
			echo "
				<script>
					parent.location.href='".$sy['post']->view_url($in['seq'])."';
				</script>
			";
		}
		else $sy['js']->alert(lang('Post_secret_check error1'));
	}
	else $sy['js']->alert(lang('Post_secret_check error2'));
}
else $sy['js']->alert(lang('Post_secret_check error3'));
?>