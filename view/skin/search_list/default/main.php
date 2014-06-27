<?=skin_css($so, __FILE__)?>
<div id='search-list-skin'>
	<div id='no_of_post'>
		<? if ( $in['username'] ) {?>
			<b><?=$in['username']?></b><?=lang('search list message1')?>
		<?}?>
		<?=lang('search list message2')?> <b><?=number_format($so['total_post'])?></b><?=lang('search list message3')?>
	</div>
<?php
foreach ( $posts as $p ) {
	if ( $in['search_post_comment'] == 'post' )  {
		$subject = stringcut($p['subject']);
		foreach ( $so['keyword'] as $key ) {
			$subject = str_replace($key, "<span class='search-keyword'>$key</span>", $subject);
		}
		
		$view_url = $sy['post']->view_url($p['seq']);
		if ( $image_url = imageresize ( $p['first_image'], 100, 72) ) {
			$image = "<td width='116'><div class='photo'><a href='$view_url'><img src='".$image_url."' /></a></div></td>";
		} else $image = null;		
	} else {
		$view_url = $sy['post']->view_url($p['seq_root'])."#comment_".$p['seq'];
	}
	
	$content = stringcut($p['content'], 200);
	foreach ( $so['keyword'] as $key ) {
		$content = str_replace($key, "<span class='search-keyword'>$key</span>", $content);
	}
	
	$username = $p['nickname'];
	$date = date('Y-m-d H:i', $p['stamp']);
?>
	<div class='row'>
		<table border=0 cellpadding=0 cellspacing=0 width='100%'>
			<tr valign='top'>
				<?=$image?>
				<td>
					<div class='container'>
					<?php if ( $in['search_post_comment'] == 'post' )  {?>
							<div class='subject'><a href='<?=$view_url?>'><?=$subject?></a></div>
					<? }?>
						<div class='content'><a href='<?=$view_url?>'><?=$content?></a></div>
						<div class='user-info'>
							<span class='username'><b><?=lang('search list poster')?></b><?=$username?></span>
							<span class='date'><b><?=lang('search list date')?></b><?=$date?></span>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
<?}?>
</div>