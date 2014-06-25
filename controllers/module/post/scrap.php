<?php
if ( empty($in['seq']) ) return $sy['js']->alert(lang('Post_scrap error1'));

if ( !$sy['mb']->is_login() ) return $sy['js']->alert(lang('Post_scrap error2'));

if ( $sy['post']->is_scrapped($in['seq']) )  return $sy['js']->alert(lang('Post_scrap error3'));
else {
	if ( $sy['post']->scrap($in['seq']) ) {
		echo "
			<script>
				$(document).ready(function() {
					parent.scrap_done();
				});
			</script>
		";
	}
	else $sy['js']->alert(lang('Post_scrap error4'));

	
}
?>