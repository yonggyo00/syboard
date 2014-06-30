<?php
if ( $in['option'] == 'sended_msg' ) {
	$result = null;
	if ( $in['seq'] ) {
		if ( $in['mode'] == 'delete' ) {
			foreach ( $in['seq'] as $seq ) {
				$message = $sy['db']->row("SELECT sender_deleted as sd, receiver_deleted as rd FROM " . MESSAGE_DATA_TABLE . " WHERE `seq`='".$seq."'");
				
				if ( $message['rd'] == 'Y' ) {
					$result = $sy['db']->delete(MESSAGE_DATA_TABLE, array('seq'=>$seq));
				} else {
					$result = $sy['db']->update(MESSAGE_DATA_TABLE, array('sender_deleted'=>'Y'), array('seq'=>$seq));
				}
			}
			
			if ( $result ) {
				$sy['js']->alert(lang('message list deleted'));
				echo "
					<script>
						parent.location.reload();
					</script>
				";
			}
		}
	}
}
else {
	if ( $in['mode'] == 'check_readed' ) {
		$result = null;
		if ( $in['seq'] ) {
			foreach ( $in['seq'] as $seq ) {
				$result = $sy['db']->update(MESSAGE_DATA_TABLE, array('receiver_readed'=>'Y', 'readed_stamp'=>time()), array('seq'=>$seq));
			}
			
			if ( $result ) {
				$sy['js']->alert(lang('message list change_readed'));
				echo "
					<script>
						parent.location.reload();
					</script>
				";
			}
		}
	}
	else if ( $in['mode'] == 'delete' ) {
		$result = null;
		if ( $in['seq'] ) {
			foreach ( $in['seq'] as $seq ) {
				$message = $sy['db']->row("SELECT sender_deleted as sd, receiver_deleted as rd FROM " . MESSAGE_DATA_TABLE . " WHERE `seq`='".$seq."'");
				
				if ( $message['sd'] == 'Y' ) {
					$result = $sy['db']->delete(MESSAGE_DATA_TABLE, array('seq'=>$seq));
				} else {
					$result = $sy['db']->update(MESSAGE_DATA_TABLE, array('receiver_deleted'=>'Y'), array('seq'=>$seq));
				}
			}

			if ( $result ) {
				$sy['js']->alert(lang('message list deleted'));
				echo "
					<script>
						parent.location.reload();
					</script>
				";
			}
		}
	}
	else if ( $in['mode'] == 'reply' ) {
		if ( $in['seq'] ) {
			$conds = array();
			foreach ( $in['seq'] as $seq ) {
				$conds[] = "`seq`='".$seq."'";
			}
			if ( $conds ) $where = " WHERE " . implode(" OR ", $conds );
			
			if($where ) $rows = $sy['db']->rows("SELECT sender FROM " . MESSAGE_DATA_TABLE . $where);
			
			$senders = array();
			foreach( $rows as $row ) {
				$senders[] = $row['sender'];
			}
			
			$senders = array_unique($senders);
			
			$senders = array_unique($senders);
			$sender = implode(",", $senders);
			$write_url = $sy['ms']->write_url($sender, $in['layout_mode']);
			echo "
				<script>
					parent.location.href='".$write_url."';
				</script>
			";
		}
	}
}
?>