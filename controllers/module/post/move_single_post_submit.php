<?php
if ( empty($in['seq']) ) return $sy['js']->back("잘못된 접근입니다.");

if ( empty($in['move_post_id']) ) return $sy['js']->back("이동할 게시판을 선택하세요.");

$p = $sy['post']->single_post($in['seq'], "seq, seq_member, subject");

if ( !admin() && !$sy['post']->admin() && !site_admin() ) {
	if ( !$sy['post']->my_post($p['seq_member']) ) return $sy['js']->back("본인 글이 아니면 게시글 이동을 하실 수 없습니다.");
}

$sy['post']->move_post($in['seq'], $in['move_post_id']);

$sy['js']->location("게시글이 이동하였습니다.", $sy['post']->list_url($in['move_post_id']));
?>