<?php
if ( empty($in['move_post_id']) ) return $sy['js']->back("게시판 아이디를 선택하세요.");

if ( empty($in['seq']) ) return $sy['js']->back("게시글을 선택하세요.");

foreach ( $in['seq'] as $seq ) {
	$result = $sy['post']->move_post($seq, $in['move_post_id']);
}
 
$sy['js']->location("게시물이 이동하였습니다.", $sy['post']->list_url($in['move_post_id']));
?>
