<?php
class message {

	public function write_url ( $receiver = null, $mode = 0 ) {
		
		$url = "?module=message&action=write";
		
		if ( $mode != 1 ) $url .= "&layout=1";
		
		if ( $receiver ) $url .= "&receiver=".$receiver;
		
		return $url;
	}
	
	public function list_url ($mode = 0) {
		
		$url = "?module=message&action=list";
		if ( $mode != 1 ) $url .= "&layout=1";
		
		return $url;
	}
	
	public function view_url ( $seq, $mode = 0 ) {
	
		$url = "?module=message&action=view&seq=".$seq;
		
		if ( $mode != 1 ) $url .= "&layout=1";
		
		return $url;
	}
	
	public function send ( $option ) {
		global $sy;
		
		unset($option['module']);
		unset($option['action']);
		unset($option['layout']);
		unset($option['mode']);
		
		if ( empty($option['first_file']) ) unset($option['first_file']);
		
		$content_start = strpos($option['content'], "<body>");
		$content_end = strpos($option['content'], "</body>");
		
		$content = trim(substr($option['content'], $content_start + 6, $content_end - ($content_start + 6)));
		
		$content = str_replace("\\r\\n", "", $content);
		
		$option['content'] = $content;
		
		$option['subject'] = strip_tags($option['subject'] );
		
		if ( $option['subject'] && $content ) {
			$option['stamp'] = time();
			$option['user_agent'] = user_agent();
			$option['ip'] = ip_2_long($_SERVER['REMOTE_ADDR']);
			
			return $sy['db']->insert(MESSAGE_DATA_TABLE, $option );
		}
		else return $sy['js']->alert(lang('post class error1'));
		
		
	}
	
	public function my_message( $page_no = 1, $no_of_post = 20, $mode = null ) {
		global $sy, $_member;
		
		if ( empty($page_no) ) $page_no = 1;
		
		$start = ( $page_no - 1 ) * $no_of_post;
		$limit = "LIMIT $start, $no_of_post";
		
		$conds = null;
		
		$receiver = "receiver='".$_member['username']."'";
		$deleted = "receiver_deleted='N'";
		
		$order = "ORDER BY stamp DESC";
		
		if ( $mode == 'unreaded' ) $conds = "receiver_readed='N'";
		else if ( $mode == 'important' ) $conds = "important='Y'";
		else if ( $mode == 'attached' ) $conds = "first_file > 0"; 
		else if ( $mode == 'received_msg' ) $conds = "sender != '".$_member['username'] ."'";
		else if ( $mode == 'my_msg' ) $conds = "sender = '".$_member['username'] . "'";
		else if ( $mode == 'sended_msg' ) {
			$receiver = "sender='".$_member['username'] . "'";
			$deleted = "sender_deleted='N'";
		}
		else if ( $mode == 'orderbyreceiver' ) {
			$order = "ORDER BY sender ASC, stamp DESC";
		}
		
		if ( $conds ) $conds = " AND ".$conds;
		
		return $sy['db']->rows("SELECT seq, stamp, sender, receiver, subject, receiver_deleted, receiver_readed, first_file, important, readed_stamp FROM " . MESSAGE_DATA_TABLE . " WHERE  $receiver AND $deleted $conds $order $limit");
	}
	
	public function total_of_my_message($mode = null) {
		global $sy, $_member;
		
		$conds = null;
		
		$receiver = "receiver='".$_member['username']."'";
		
		if ( $mode == 'unreaded' ) $conds = "receiver_readed='N'";
		else if ( $mode == 'important' ) $conds = "important='Y'";
		else if ( $mode == 'attached' ) $conds = "first_file > 0"; 
		else if ( $mode == 'received_msg' ) $conds = "sender != '".$_member['username'] ."'";
		else if ( $mode == 'my_msg' ) $conds = "sender = '".$_member['username'] . "'";
		else if ( $mode == 'sended_msg' ) $receiver = "sender='".$_member['username'] . "'";
		
		if ( $conds ) $conds = " AND ".$conds;
		
		$count = $sy['db']->row("SELECT COUNT(*) as cnt FROM " . MESSAGE_DATA_TABLE . " WHERE $receiver AND receiver_deleted='N' $conds");
		
		return $count['cnt'];
	}
	
	public function view_message ( $seq ) {
		global $sy;
		
		return $sy['db']->row("SELECT * FROM " . MESSAGE_DATA_TABLE . " WHERE `seq`='".$seq."'");
	}
	
	public function update_message_readed() {
		global $message, $_member, $sy;
		if ( $message['receiver'] == $_member['username'] ) {
			return $sy['db']->update(MESSAGE_DATA_TABLE, array('receiver_readed'=>'Y', 'readed_stamp'=>time()), array('seq'=>$message['seq']));
		}
	}
	
	public function update_message_important($seq, $mode) {
		global $sy;
		
		if ( $mode == 'important' ) {
			$option = array('important' => 'Y');
		} else if ( $mode == 'unimportant' ) {
			$option = array('important' => 'N');
		}
		
		return $sy['db']->update(MESSAGE_DATA_TABLE, $option, array('seq'=>$seq));
	}
	
	
	public function no_of_unreaded() {
		global $sy, $_member;
		
		
		$option = array(
						'receiver'=>$_member['username'],
						'receiver_deleted' => 'N', 
						'receiver_readed' => 'N'
		);
		return $sy['db']->count(MESSAGE_DATA_TABLE, $option );
	}
	
	public function sendto( $username, $mode = 0 ) {
		
		$url = '?module=message&action=write&receiver='.$username;
		
		if ( $mode != 1 ) $url .= "&layout=1";
		return $url;
	}
	
}
?>