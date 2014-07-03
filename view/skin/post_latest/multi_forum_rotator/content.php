<?php
if ( !$post_id = $first_pid ) $post_id = $in['pid']; // 게시판 아이디 
if ( !$skin_no = $in['skin_no'] ) $skin_no = 1; // 게시물 시작 점

$query = "SELECT seq, subject, first_image FROM ".POST_DATA_TABLE . " WHERE post_id='$post_id' AND first_image > 0";

$cache_name=$pid."_".$skin_no."_".md5($query)."_5";

$posts = $sy['post']->latest_posts($query, $cache_name, 20, $skin_no, 6 );

$i = 0;
foreach ( $posts as $post ) {
	$image_url = imageresize($post['first_image'], 115, 115);
	$image = "<img src='$image_url' style='border:0;'/>";
	
	$view_url = $sy['post']->view_url($post['seq']);
	
	$subject = stringcut($post['subject'], 45);
	
	if ( $i == 0 ) $add_style = "margin-left";
	else $add_style = null;
	$i++;
	
	
	echo "
		<div class='post-latest-content-cel $add_style'>
			<div class='photo'><a href='$view_url'>$image</a></div>
			<div class='subject'><a href='$view_url'>$subject</a></div>
		</div>
	";
}
?>
<div style='clear:left;'></div>