<?php
if ( admin() || $sy['post']->admin() || site_admin() ) {
	if ( empty($in['seq']) ) return $sy['js']->alert(lang('member block error1'));

	if ( $in['mode'] == 'comment' ) {
		if ( $block_no = $sy['mb']->check_comment_block($in['seq']) ) return $sy['js']->alert(lang('member block error2').$block_no);
		
		if ( $insert_id = $sy['mb']->comment_block($in['seq']) ) {
			$sy['js']->alert(lang('member block success').$insert_id);
		}
		else $sy['js']->alert(lang('member block error3')); 
	}
	else {
		if ( $block_no = $sy['mb']->check_block($in['seq']) ) return $sy['js']->alert(lang('member block error2').$block_no);

		if ( $insert_id = $sy['mb']->block($in['seq']) ) {
			$sy['js']->alert(lang('member block success').$insert_id);
		}
		else $sy['js']->alert(lang('member block error3')); 
	}
} else $sy['js']->alert(lang('member block error4'));
?>