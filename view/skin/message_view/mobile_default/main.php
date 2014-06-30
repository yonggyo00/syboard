<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<?php
$message = $so['message'];
$userinfo = $sy['mb']->info($message['sender']);
$re_subject = urlencode('[RE] '.$message['subject']);
?>
<div id='message-view-skin'>
	<div id='user-info'>
		<span id='receiver'><b><?=lang('message view sender')?></b>
			<a href='<?=$sy['ms']->sendto($userinfo['username'])?>&subject=<?=$re_subject?>'>
				<?=$userinfo['nickname']?>(<?=$userinfo['username']?>)
			</a>
		</span>
		<span id='date'><b><?=lang('message view date')?></b><?=date('Y-m-d H:i', $message['stamp'])?></span>
	</div>
	
	<div id='subject'><?=stripslashes($message['subject'])?></div>
	<div id='content'><?=stripslashes($message['content'])?></div>
	<a id='reply-button' href='<?=$sy['ms']->sendto($userinfo['username'])?>&subject=<?=$re_subject?>'><?=lang('message view reply')?></a>
	<div style='clear:right;'></div>
</div>