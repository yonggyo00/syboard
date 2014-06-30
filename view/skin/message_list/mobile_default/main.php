<?php
$messages = $so['messages'];
$total_post = $so['total_post'];

$unread = "<img src='".$so['path'].'/img/unread.png'."' align='center' />";
$readed = "<img src='".$so['path'].'/img/readed.png'."' align='center' />";
?>
<?=skin_css($so, __FILE__)?>
<?=skin_javascript($so, __FILE__)?>
<div id='message-list-skin'>
<?php
	foreach ( $messages as $ms ) {
		$view_url = $sy['ms']->view_url($ms['seq'], 1);
		$subject = stringcut($ms['subject'], 30);
					
		if ( $ms['readed_stamp'] ) {
			$read = $readed;
			$selected = "class='selected'";
		}
		else {
				$read = $unread;
				$selected = null;
		}
					
		if ( $ms['first_file'] ) $file = $attached;
		else $file = null;
							
		
		$write_url = $sy['ms']->view_url($ms['sender'], 1);
		$checkbox = "<input class='seq_check' type='checkbox' name='seq[]' value='$ms[seq]' />";
	?>
		<div class='row'>
			<a class='subject' <?=$selected?> href='<?=$view_url?>'><?=$checkbox?><?=$read?><?=$subject?></a><a class='sender' href='<?=$write_url?>'><?=$ms['sender']?></a>
		</div>
					
					
	<?}?>
	<div id='control-pannel'>
		<span id='select-all'><?=lang('List bottom select select all')?></span>
		<span id='check_readed'><?=lang('message list main mark read')?></span>
		<span id='delete' onclick="return confirm('<?=lang('message list main confirm delete')?>');">
			<img src='<?=$so['path']?>/img/x.png' /><?=lang('message list main delete')?>
		</span>
		<span id='reply'><?=lang('message list main reply')?></span>
	</div>
</div>