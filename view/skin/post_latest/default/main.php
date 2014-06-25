<?php
echo skin_css($so, __FILE__);
$query = "SELECT seq, seq_member, subject, stamp, secret FROM " . POST_DATA_TABLE . " WHERE post_id='".$so['post_id']."'";

$cache_name = $so['post_id']."_".md5($query);

if ( !$no_of_post = $so['no_of_post'] )  $no_of_post = 5;

$posts = $sy['post']->latest_posts($query, $cache_name, 20, 1, $no_of_post);
?>
<div id='post-latest-default-skin'>
	<div id='title'>
		<a href='?<?=$so['post_id']?>'><?=$so['title']?></a>
	</div>
<?php
	foreach ( $posts as $p ) {
		$view_url = $sy['post']->view_url($p['seq']);
		if ( !$length = $so['length'] ) $length = 60;
		$subject = stringcut($p['subject'], $length);
		
		$secret = null;
		if  ( $p['secret'] ) {
			$secret = "<span class='secret'>[".lang('List view secret')."]</span>";
			if ( !$sy['post']->my_post($p['seq_member']) && !admin() && !$sy['post']->admin() ) $view_url = $sy['post']->view_secret_check_url($p['seq']);
		}
?>
		<div class='row'>
			<a href='<?=$view_url?>'><?=$secret.$subject?></a>
		</div>
<?}?>
</div>