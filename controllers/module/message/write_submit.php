<?php
if ( empty($in['sender']) && $in['receiver'] ) return $sy['js']->alert("보내는 사람을 입력하세요.");
else if ( empty( $in['receiver'] ) && $in['sender'] ) return $sy['js']->alert("받는 사람을 입력하세요.");
else if ( empty($in['sender']) && empty($in['receiver']) ) return $sy['js']->alert("보내는 사람과 받는사람을 모두 입력하세요.");

foreach ( explode(",", $in['receiver']) as $re ) {
	// 사용자 확인 
	$sender_check = $sy['mb']->username_check ( $in['sender'] );
	$receiver_check = $sy['mb']->username_check ( $re );
	if ( empty ( $sender_check ) && empty ( $receiver_check ) ) return $sy['js']->alert("아이디 ".$in['sender']."와(과)".$in['receiver']."는 존재 하지 않습니다.");
	else if ( empty ( $sender_check ) && $receiver_check ) return $sy['js']->alert("아이디 ".$in['sender']."(은)는 존재 하지 않습니다.");
	else if ( $sender_check && empty($receiver_check )) return $sy['js']->alert("아이디 ".$re."(은)는 존재 하지 않습니다.");
	else if ( $sender_check && $receiver_check ) {
		
		$option = array();
		$option = $in;
		$option['receiver'] = $re;
		
		$insert_id = $sy['ms']->send($option);
		if ( $insert_id ) {
			$msg = "쪽지가 전달 되었습니다.";
			
			$sy['file']->file_insert_finished($in['gid']);
			
		}
		else $msg = "쪽지 전달에 실패 하였습니다.";
		?>
		<script>
		alert('<?=$msg?>');
		parent.window.location.href="<?=$sy['ms']->list_url()?>";
		</script>
	<?}?>

<?}?>
