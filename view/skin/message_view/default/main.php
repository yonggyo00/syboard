<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
$message = $so['message'];
$userinfo = $sy['mb']->info($message['sender']);
$re_subject = urlencode("[답장]".$message['subject']);
?>
<table id='message-view-skin' cellspacing=0 cellpadding=0 width='100%' border=0>
	<tr valign='top'>
		<td width='28%'>
			<?php
				include_once 'left.php';
			?>
		</td>
		<td width='72%'>
			<div id='user-info'>
				<span id='receiver'><b>보낸이</b>
					<a href='<?=$sy['ms']->sendto($userinfo['username'])?>&subject=<?=$re_subject?>'>
						<?=$userinfo['nickname']?>(<?=$userinfo['username']?>)
					</a>
				</span>
				<span id='date'><b>보낸일</b><?=date('Y-m-d H:i', $message['stamp'])?></span>
			</div>
			<div id='subject'><?=stripslashes($message['subject'])?></div>
			<div id='content'><?=stripslashes($message['content'])?></div>
			<a id='reply-button' href='<?=$sy['ms']->sendto($userinfo['username'])?>&subject=<?=$re_subject?>'>답장 보내기</a>
			<div style='clear:right;'>
		</td>
	</tr>
</table>