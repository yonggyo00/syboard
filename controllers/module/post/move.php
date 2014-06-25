<?php
if ( empty($in['move_post_id']) ) return $sy['js']->back(lang('Post_move error1'));

if ( empty($in['seq']) ) return $sy['js']->back(lang('Post_move error2'));

foreach ( $in['seq'] as $seq ) {
	$result = $sy['post']->move_post($seq, $in['move_post_id']);
}
 
$sy['js']->location(lang('Post_move error3'), $sy['post']->list_url($in['move_post_id']));
?>
