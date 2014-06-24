<?=skin_css($so, __FILE__)?>
<?php
$reminders = $so['reminder'];
if ( $reminders ) {
?>
<div id='post-list-reminder-skin'>
	<span id='title'>공지</span>
<?php
	foreach ( $reminders as $re ) {
		if ( $re['seq'] == $in['seq'] ) $add_re_style = "selected";
		else $add_re_style = null;
		
		$view_url = $sy['post']->view_url($re['seq']);
		$subject = stringcut($re['subject'], 150);
	?>
		<div class='row <?=$add_re_style?>'>
			<a href='<?=$view_url?>'><?=$subject?></a>
		</div>
<?	}?>
</div>
<? }?>