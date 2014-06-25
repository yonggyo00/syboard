<?php
if ( empty($in['seq']) ) return $sy['js']->back(lang('Post_move error4'));

if ( empty($in['move_post_id']) ) return $sy['js']->back(lang('Post_move error1'));

$p = $sy['post']->single_post($in['seq'], "seq, seq_member, subject");

if ( !admin() && !$sy['post']->admin() && !site_admin() ) {
	if ( !$sy['post']->my_post($p['seq_member']) ) return $sy['js']->back(lang('Post_move error5'));
}

$sy['post']->move_post($in['seq'], $in['move_post_id']);

$sy['js']->location(lang('Post_move error3'), $sy['post']->list_url($in['move_post_id']));
?>