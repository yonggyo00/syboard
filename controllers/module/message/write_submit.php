<?php
if ( empty($in['sender']) && $in['receiver'] ) return $sy['js']->alert(lang('message write error1'));
else if ( empty( $in['receiver'] ) && $in['sender'] ) return $sy['js']->alert(lang('message write error2'));
else if ( empty($in['sender']) && empty($in['receiver']) ) return $sy['js']->alert(lang('message write error6'));

foreach ( explode(",", $in['receiver']) as $re ) {
	// 사용자 확인 
	$sender_check = $sy['mb']->username_check ( $in['sender'] );
	$receiver_check = $sy['mb']->username_check ( $re );
	if ( empty ( $sender_check ) && empty ( $receiver_check ) ) return $sy['js']->alert(lang('message write error3').$in['sender'].lang('message write error4').$in['receiver'].lang('message write error5'));
	else if ( empty ( $sender_check ) && $receiver_check ) return $sy['js']->alert(lang('message write error3').$in['sender'].lang('message write error5'));
	else if ( $sender_check && empty($receiver_check )) return $sy['js']->alert(lang('message write error3').$re.lang('message write error5'));
	else if ( $sender_check && $receiver_check ) {
		
		$option = array();
		$option = $in;
		$option['receiver'] = $re;
		
		$insert_id = $sy['ms']->send($option);
		if ( $insert_id ) {
			$msg = lang('message write success');
			
			$sy['file']->file_insert_finished($in['gid']);
			
			?>
			<script>
				alert('<?=$msg?>');
				parent.window.location.href="<?=$sy['ms']->list_url()?>";
			</script>
	<?	}
	}?>

<?}?>
